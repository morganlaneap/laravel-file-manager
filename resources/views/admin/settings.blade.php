@extends('layouts.master')

    @section('content')
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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

                        <h2><i class="fa fa-wrench"></i>&nbsp;&nbsp;System Settings</h2>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <form method="post" action="{{route('admin.settings.save')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Site Name</b></label>
                                    <p>This is the name of your LaravelFileManager instance.</p>
                                    <input name="siteName" id="siteName" class="form-control" value="{{ \App\Helpers\ConfigHelper::getValue('site_name') }}" />
                                </div>

                                <div class="form-group">
                                    <label><b>Footer Message</b></label>
                                    <p>You can customise the footer message for the application.</p>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="showFooter" id="showFooter" checked="{{ \App\Helpers\ConfigHelper::getValue('show_footer_message') }}"> Show footer message
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Save Changes</button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection