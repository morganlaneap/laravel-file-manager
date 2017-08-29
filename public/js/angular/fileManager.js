var fileManagerApp = angular.module('fileManager', ['angularFileUpload']);

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

    uploader.onBeforeUploadItem = function() {
        $scope.uploader.formData = [{
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

    $scope.createFolder = function(folder) {
        var data = {
            name: $scope.folder_name,
            description: $scope.folder_desc,
            parent: 0,
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
        });
    }
});
