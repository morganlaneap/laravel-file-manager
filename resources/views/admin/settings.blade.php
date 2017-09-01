@extends('layouts.master')

    @section('content')
        <div ng-controller="settingsController">
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

                            <h2><i class="fa fa-wrench"></i>&nbsp;&nbsp;System Settings</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">

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
                                                    @if(\App\Helpers\ConfigHelper::getValue('show_footer_message') == '1')
                                                        <input ng-click="checkShowFooterBox();" type="checkbox" name="showFooter" id="showFooter" checked=""> Show footer message
                                                    @else
                                                        <input ng-click="checkShowFooterBox();" type="checkbox" name="showFooter" id="showFooter"> Show footer message
                                                    @endif

                                                </label>
                                            </div>

                                            <div ng-show="showFooterTextbox">
                                                <label>Footer text:</label>
                                                <input type="text" class="form-control" name="footerMessage" value="{{ \App\Helpers\ConfigHelper::getValue('footer_message') }}" />
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
        </div>
    @endsection