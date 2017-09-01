@extends('layouts.master')

@section('content')
    <div ng-controller="userManagementController">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has("result"))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('result') }}
                            </div>
                        @endif

                        <h2><i class="fa fa-users"></i>&nbsp;&nbsp;User Management</h2>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Search users:</b></label>
                                    <input type="text" name="userSearch" ng-model="userSearch" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label style="color:white;">_</label><br/>
                                <button ng-click="getUsers();" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                        <div fm-loading="results" class="text-center" style="margin-top: 10px;">
                            <i class="fa fa-spin fa-refresh fa-3x"></i>
                        </div>

                        <div id="results">
                            <table class="table table-responsive table-hover">
                                <thead><tr>
                                    <th>Username</th>
                                    <th>Email Address</th>
                                    <th>Actions</th>
                                </tr></thead>
                                <tr ng-repeat="u in userResults">
                                    <td>@{{ u.name }}</td>
                                    <td>@{{ u.email }}</td>
                                    <td><a class="btn btn-default btn-sm" href="{{route('admin.users.view')}}/@{{ u.id }}"><i class="fa fa-search"></i></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection