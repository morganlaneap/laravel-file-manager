<div ng-controller="explorerController" ng-init="getFiles()" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span id="explorer-url" class="hidden">{{route('explorer.files')}}</span>
                <span id="explorer-delete-url" class="hidden">{{route('explorer.delete')}}</span>

                <table class="table table-hover table-responsive">
                    <thead>
                        <th>File Name</th>
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
