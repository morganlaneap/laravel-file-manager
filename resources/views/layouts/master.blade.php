<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Helpers\ConfigHelper::getValue('site_name') }} - LaravelFileManager</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://bootswatch.com/paper/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        // urls
        var upload_url = '{{route('file.upload')}}';
        var explorer_files_url = '{{route('explorer.files')}}';
        var explorer_folders_url = '{{route('explorer.folders')}}';
        var explorer_parent_url = '{{route('explorer.folder.parent')}}';
        var explorer_delete_url = '{{route('explorer.delete')}}';
        var explorer_create_url = '{{route('explorer.folder.create')}}';
        var explorer_rename_file_url = '{{route('explorer.file.rename')}}';
        var explorer_rename_folder_url = '{{route('explorer.folder.rename')}}';
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
    <!-- Angular Resources -->
    <script src="{{ asset('js/angular/angular-file-upload.min.js')}}"></script>
    <script src="{{ asset('js/angular/fileManager.js') }}"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{--LaravelFileManager--}}
                    {{ \App\Helpers\ConfigHelper::getValue('site_name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{route('home')}}"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;My Files</a></li>

                    @if (Auth::user()->user_type == 'admin')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-wrench"></i>&nbsp;&nbsp;Settings <span class="caret"></span>
                            </a>


                            <ul class="dropdown-menu" role="menu">
                                <li><a><i class="fa fa-users"></i>&nbsp;&nbsp;Manage Users</a></li>
                                <li><a href="{{route('admin.settings')}}"><i class="fa fa-cogs"></i>&nbsp;&nbsp;System Settings</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user-circle-o"></i>&nbsp;&nbsp; {{ Auth::user()->name }} <span class="caret"></span>
                            </a>


                            <ul class="dropdown-menu" role="menu">
                                <li>
                                  <a href="{{ route('profile') }}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div ng-app="fileManager">
    @yield('content')
    </div>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span>
                        @if(\App\Helpers\ConfigHelper::getValue('show_footer_message'))
                            {{ \App\Helpers\ConfigHelper::getValue('footer_message') }} |
                        @endif
                        <i class="fa fa-github"></i>&nbsp;&nbsp;<a target="_blank" href="https://github.com/morganlaneap/laravel-file-manager">Project GitHub</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/toastr.min.js')}}"></script>
<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
