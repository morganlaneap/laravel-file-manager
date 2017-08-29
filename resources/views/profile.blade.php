@extends('layouts.master')

@section('content')
<div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @if (Session::has("result"))
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('result') }}
          </div>
        @endif

        <h2>Profile</h2>
      </div>
    </div>
  </div>

  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <form method="post" action="{{route('profile.update')}}">
            {{csrf_field()}}
            <div class="form-group">
              <label><b>Email Address:</b></label>
              <input name="email" id="email" class="form-control" type="email" required="" value="{{Auth::user()->email}}" />
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
