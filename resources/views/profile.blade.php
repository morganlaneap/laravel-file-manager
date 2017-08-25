@extends('layouts.master')

@section('content')
<div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Profile</h2>
      </div>
    </div>
  </div>

  <div ng-app="profile" ng-controller="profileController">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <form name="profileForm">
            <div class="form-group">
              <input type="text" class="form-control @{{textClass}}" ng-model="textClass" />
            </div>

            <input name="userEmail" type="email" class="form-control" ng-model="email" />
            <span class="text-danger" ng-show="profileForm.userEmail.$error.email">Not a valid email!</span>

            <div ng-repeat="x in names | orderBy:'number'">
                @{{ x.number }}<br/>
            </div>

            <input name="userFirstName" type="text" class="form-control" ng-model="firstName | uppercase" />
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
