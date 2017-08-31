<div  ng-controller="explorerController" ng-init="folder=0; getFiles()">
<div>
    <div class="container">
        <div class="row">
            <span class="hidden" ng-bind="folder" id="current-folder"></span>
            <div class="col-md-12">

                <div fm-loading="explorer" class="text-center">
                    <i class="fa fa-spin fa-refresh fa-3x"></i>
                </div>

                <div id="explorer">
                    <span ng-show="folders.length+files.length==0 && folder==0">No files found.</span>
                    <table class="table table-hover table-responsive" ng-show="folder==0 ? folders.length + files.length>0 : true">
                        <thead>
                            <th class="sortable" ng-click="orderByMe('file_name')"><i class="fa fa-sort"></i>&nbsp;&nbsp;Name</th>
                            <th>Type</th>
                            <th class="sortable" ng-click="orderByMe('file_size')"><i class="fa fa-sort"></i>&nbsp;&nbsp;Size</th>
                            <th class="sortable" ng-click="orderByMe('updated_at')"><i class="fa fa-sort"></i>&nbsp;&nbsp;Date Modified</th>
                            <th>Actions</th>
                        </thead>
                        <tr class="clickable-row" ng-hide="folder==0" ng-click="getParentFolderId()">
                            <td>
                                <i class="fa fa-level-up fa-2x"></i>&nbsp;&nbsp;..
                            </td>
                            <td></td><td></td><td></td><td></td>
                        </tr>
                        {{-- This row is for the folders, they act as a dropzone for files. --}}
                        <tbody>
                            <tr class="dropzone clickable-row" data-folder="@{{ f.id }}" ng-repeat="f in folders | orderBy:myOrderBy" ng-click="$parent.folder=f.id; getFiles()" ui-sortable="dropzone" ng-model="dropzoneFiles">
                                <td><i class="fa fa-folder fa-2x" style="vertical-align:  -20%;"></i>&nbsp;&nbsp;&nbsp;&nbsp;@{{ f.folder_name }}</td>
                                <td>Folder</td>
                                <td></td>
                                <td>@{{ f.updated_at }}</td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="{{route('explorer.download')}}/@{{ file.id }}"><i class="fa fa-download"></i></a>
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rename-folder-modal" ng-click="$parent.folderName=f.folder_name; $parent.folderId=f.id; showFolderRenameModal($event);"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        {{-- This section is the files. They can be dragged to folders. --}}
                        <tbody ui-sortable="draggable" ng-model="files">
                            <tr ng-repeat="file in files | orderBy:myOrderBy" data-file="@{{ file.id }}">
                                {{--<td class="hidden">@{{ file.id }}</td>--}}
                                <td><i class="fa fa-file-text-o fa-2x" style="vertical-align: -20%;"></i>&nbsp;&nbsp;&nbsp;&nbsp;@{{ file.file_name }}</td>
                                <td>@{{ file.file_extension }}</td>
                                <td>@{{ file.file_size/1024/1024|number:2 }} MB</td>
                                <td>@{{ file.updated_at }}</td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="{{route('explorer.download')}}/@{{ file.id }}"><i class="fa fa-download"></i></a>
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rename-file-modal" ng-click="$parent.fileName=file.file_name; $parent.fileId=file.id;"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-sm" ng-click="deleteFile(file.id)"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- add folder modal -->
<div class="modal fade" id="folder-create-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create folder...</h4>
            </div>
                <div class="modal-body">
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
<!-- rename file modal -->
<div class="modal fade" id="rename-file-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rename file...</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><b>File Name:</b></label>
                    <input type="text" ng-model="fileName" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</button>
                <button type="button" class="btn btn-success" ng-click="renameFile()"><i class="fa fa-save"></i>&nbsp;&nbsp;Save Changes</button>
            </div>
        </div>
    </div>
</div>

    <!-- rename folder modal -->
    <div class="modal fade" id="rename-folder-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Rename folder...</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><b>Folder Name:</b></label>
                        <input type="text" ng-model="folderName" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</button>
                    <button type="button" class="btn btn-success" ng-click="renameFolder()"><i class="fa fa-save"></i>&nbsp;&nbsp;Save Changes</button>
                </div>
            </div>
        </div>
    </div>

</div>