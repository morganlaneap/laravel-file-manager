<div ng-controller="explorerController" ng-init="getFiles()" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span id="explorer-url" class="hidden">{{route('explorer.files')}}</span>
                <span id="explorer-delete-url" class="hidden">{{route('explorer.delete')}}</span>

                <table class="table table-hover table-responsive">
                    <thead>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Date Modified</th>
                        <th>Actions</th>
                    </thead>
                    <tr ng-repeat="file in files">
                        <td>@{{ file.file_name }}</td>
                        <td>@{{ file.file_size/1024/1024|number:2 }} MB</td>
                        <td>@{{ file.updated_at }}</td>
                        <td>
                            <a class="btn btn-default btn-sm" href="{{route('explorer.download')}}/@{{ file.id }}"><i class="fa fa-download"></i></a>
                            <a class="btn btn-danger btn-sm" ng-click="deleteFile(file.id)"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- add folder modal -->
<div ng-controller="explorerController" class="modal fade" id="folder-create-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create folder...</h4>
            </div>
                <div class="modal-body">
                    <span id="folder-create-url" class="hidden">{{route('folder.create')}}</span>
                    <div class="form-group">
                        <label><b>Folder Name:</b></label>
                        <input type="text" ng-model="folder_name" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label><b>Folder Description:</b></label>
                        <input type="text" ng-model="folder_desc" class="form-control" />
                    </div>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</button>
                <button type="button" class="btn btn-success" ng-click="createFolder()"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Folder</button>
            </div>
        </div>
    </div>
</div>