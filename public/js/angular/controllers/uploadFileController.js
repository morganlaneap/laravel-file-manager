uploadApp.controller('uploadFileController', ['$scope', 'FileUploader', function($scope, FileUploader) {
    var uploader = $scope.uploader = new FileUploader({
        url: $('#upload-url').html(),
        formData: [{'_token' : $('meta[name=csrf-token]').attr("content")}],
        method: 'post'
    });

    // an async filter
    uploader.filters.push({
        name: 'asyncFilter',
        fn: function(item /*{File|FileLikeObject}*/, options, deferred) {
            setTimeout(deferred.resolve, 1e3);
        }
    });

    uploader.onSuccessItem = function(fileItem, response, status, headers) {
        notify('File uploaded.', 1);
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        notify('Failed to upload file: ' + status, 3);
    };

}]);
