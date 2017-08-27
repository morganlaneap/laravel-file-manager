<div ng-controller="explorerController" ng-init="getFiles()" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span id="explorer-url" class="hidden">{{route('explorer.files')}}</span>

                <table class="table table-hover table-responsive">
                    <thead>
                        <th>File Name</th>
                        <th>Date Modified</th></thg>
                    </thead>
                    <tr ng-repeat="file in files">
                        <td>@{{ file.file_name }}</td>
                        <td>@{{ file.updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
