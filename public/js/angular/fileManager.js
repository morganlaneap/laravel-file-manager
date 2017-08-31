var fileManagerApp = angular.module('fileManager', ['angularFileUpload', 'ui.sortable']);


// Controllers //
fileManagerApp.controller('uploadFileController', ['$scope', 'FileUploader', '$rootScope', function($scope, FileUploader, $rootScope) {

    var uploader = $scope.uploader = new FileUploader({
        url: upload_url,
        formData: [{
            folder: $('#current-folder').html(),
            '_token' : $('meta[name=csrf-token]').attr("content")
        }],
        method: 'post'
    });

    // an async filter
    uploader.filters.push({
        name: 'asyncFilter',
        fn: function(item /*{File|FileLikeObject}*/, options, deferred) {
            setTimeout(deferred.resolve, 1e3);
        }
    });

    uploader.onBeforeUploadItem = function(item) {
        item.formData = [{
            folder: $('#current-folder').html(),
            '_token' : $('meta[name=csrf-token]').attr("content")
        }];
    };

    uploader.onSuccessItem = function(fileItem, response, status, headers) {
        notify('File uploaded.', 1);
        $scope.getFiles();
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        notify('Failed to upload file: ' + status, 3);
    };

    $scope.getFiles = function() {
        $rootScope.$emit('getFiles', {});
    }



}]);

fileManagerApp.controller('explorerController', function ($scope, $http, $rootScope) {
    $rootScope.$on('getFiles', function() {
        $scope.getFiles();
    });

    $scope.getFiles = function() {

        var folder = $scope.folder;

        var data = {
            folder: folder,
            '_token' : $('meta[name=csrf-token]').attr("content")
        };

        $http({
            method: 'POST',
            url: explorer_files_url,
            data: data
        }).then(function(response) {
            $scope.files = response.data;
        });

        $http({
            method: 'POST',
            url: explorer_folders_url,
            data: data
        }).then(function(response) {
            $scope.folders = response.data;
        });
    };

    $scope.getParentFolderId = function() {

        var data = {
            folder: $scope.folder,
            '_token' : $('meta[name=csrf-token]').attr("content")
        };

        $http({
            method: 'POST',
            url: explorer_parent_url,
            data: data
        }).then(function(response) {
            $scope.folder = response.data["parent_folder"];
            $scope.getFiles();
        });


    };

    $scope.deleteFile = function(id) {
        var url = explorer_delete_url;

        url = url + "/" + id;

        $http.get(url).then(function (response) {
            if (response.status == "200") {
                notify(response.msg, 1);
            } else
            {
                notify(response.msg, 3);
            }

            $scope.getFiles();
        });
    };

    $scope.createFolder = function() {
        var data = {
            name: $scope.folder_name,
            description: $scope.folder_desc,
            parent: $scope.folder,
            '_token' : $('meta[name=csrf-token]').attr("content")
        };

        $http({
            method: 'POST',
            url: explorer_create_url,
            data: data
        }).then(function(response) {
            notify(response.data, 1);
            $('#folder-create-modal').modal('hide');
            $scope.getFiles();

            $scope.folder_name = '';
            $scope.folder_desc = '';
        });
    };

    $scope.renameFile = function() {
        var data = {
            fileName: $scope.fileName,
            fileId: $scope.fileId,
            '_token' : $('meta[name=csrf-token]').attr("content")
        };

        $http({
            method: 'POST',
            url: explorer_rename_file_url,
            data: data
        }).then(function(response) {
            notify(response.data, 1);
            $('#rename-file-modal').modal('hide');
            $scope.getFiles();
        });
    };

    $scope.renameFolder = function() {
        var data = {
            id: $scope.folderId,
            name: $scope.folderName,
            '_token': $('meta[name=csrf-token]').attr('content')
        };

        $http({
            method: 'POST',
            url: explorer_rename_folder_url,
            data: data
        }).then(function(response) {
            notify(response.data, 1);
            $('#rename-folder-modal').modal('hide');
            $scope.getFiles();
        });
    };

    $scope.orderByMe = function(x) {
        $scope.myOrderBy = x;
    };

    $scope.showFolderRenameModal = function($event) {
        $event.stopPropagation();

        $('#rename-folder-modal').modal('toggle');
    };


    $scope.moveFile = function(folder, file) {


        notify('File moved.', 1);
        //$scope.getFiles();
    };

    $scope.dropzoneFiles = [];

    $scope.dragging = false;

    $scope.draggable = {
        connectWith: ".dropzone",
        start: function(e, ui) {
            $scope.$apply(function() {
               $scope.dragging = true;
            });
        },
        update: function (e, ui) {
            if (ui.item.sortable.droptarget[0].classList[0] !== "dropzone")
                ui.item.sortable.cancel();
        },
        stop: function (e, ui) {
            if (ui.item.sortable.droptarget == undefined) {
                $scope.$apply($scope.dragging = false);
            } else if (ui.item.sortable.droptarget[0].classList[0] == "dropzone") {
                $scope.$apply($scope.dragging = false);

                // Now move the file
                var folderId = $(ui.item.sortable.droptarget[0]).data('folder');
                var fileId = $(ui.item).data('file');

                $scope.moveFile(folderId, fileId);
            } else {
                $scope.$apply($scope.dragging = false);
            }
        }
    };

    $scope.dropzone = {};
});

fileManagerApp.controller('settingsController', function($scope){
   $scope.checkShowFooterBox = function() {
       $scope.showFooterTextbox = $('#showFooter').is(':checked');
   };
});



// Directives //
fileManagerApp.directive("fmLoading", function($http) {
    return {
        restrict: 'A',
        link: function(scope, elm, attrs) {
            scope.isLoading = function() {
                return $http.pendingRequests.length > 0;
            };

            scope.$watch(scope.isLoading, function (v) {
               if (v) {
                   $("#" + attrs.fmLoading).hide();
                   elm.show();
               } else {
                   $("#" + attrs.fmLoading).show();
                   elm.hide();
               }
            });
        }
    }
});

//angular.bootstrap(document, ['fileManagerApp']);