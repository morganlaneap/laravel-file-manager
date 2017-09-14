@extends('layouts.master')

@section('content')
    <div>
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

                        <h2><i class="fa fa-users"></i>&nbsp;&nbsp;View User</h2>
                    </div>
                </div>
            </div>
        </div>

        <div ng-controller="userManagementController" ng-init="userId={{$user->id}}; userQuota={{$user->disk_quota}}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">

                        <div class="row">
                            <div class="col-md-2">
                                <label><b>Upload quota (MB):</b></label>
                                <input type="number" ng-model="userQuota" class="form-control" min="0" />
                            </div>
                        </div>
<br>
                        <div class="row">
                            <div class="col-md-12">
                                <a ng-click="saveUserDetails()" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Save changes</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection