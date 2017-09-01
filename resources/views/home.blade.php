@extends('layouts.master')

@section('content')

    {{-- Include modal upload here --}}
    @include('shared.upload')

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

                    <h2><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;My Files</h2>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <a class="btn btn-default text-capitalize" data-toggle="modal" data-target="#upload-modal"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload Files</a>
                    <a class="btn btn-default text-capitalize" data-toggle="modal" data-target="#folder-create-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;New Folder</a>
                </div>
            </div>
        </div>
    </div>

        <br />

    @include('shared.explorer')

@endsection
