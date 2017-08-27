<!-- upload modal -->
<div ng-app="uploadFile" class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload files...</h4>
            </div>
            <div class="modal-body" ng-controller="uploadFileController" uploader="uploader" nv-file-drop="" filters="queueLimit">
                <span id="upload-url" class="hidden">{{route('file.upload')}}</span>

                <div ng-show="uploader.isHTML5">
                    <div class="well my-drop-zone text-center">
                        <i class="fa fa-upload fa-4x" style="opacity: 0.4;"></i>
                        <br/><h4 style="opacity: 0.4;">Drag here to upload...</h4>
                    </div>
                </div>

                <div ng-hide="uploader.isHTML5">
                    Select file...
                    <input type="file" nv-file-select="" uploader="uploader" />
                </div>

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th width="50%">Name</th>
                            <th ng-show="uploader.isHTML5">Size</th>
                            <th ng-show="uploader.isHTML5">Progress</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in uploader.queue">
                            <td><strong>@{{ item.file.name }}</strong></td>
                            <td ng-show="uploader.isHTML5" nowrap>@{{ item.file.size/1024/1024|number:2 }} MB</td>
                            <td ng-show="uploader.isHTML5">
                                <div class="progress progress-striped">
                                    <div class="progress progress-striped" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span ng-show="item.isSuccess"><i class="fa fa-check"></i></span>
                                <span ng-show="item.isCancel"><i class="fa fa-ban"></i></span>
                                <span ng-show="item.isError"><i class="fa fa-close"></i></span>
                            </td>
                            <td nowrap>
                                <button type="button" class="btn btn-success btn-sm" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                    <span class="fa fa-upload"></span>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" ng-click="item.cancel()" ng-disabled="!item.isUploading">
                                    <span class="fa fa-ban"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" ng-click="item.remove()">
                                    <span class="fa fa-close"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</button>
                <button type="button" class="btn btn-success" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload All</button>
            </div>
        </div>
    </div>
</div>