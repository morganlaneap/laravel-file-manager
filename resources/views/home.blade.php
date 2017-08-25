@extends('layouts.master')

@section('content')
    {{-- Include modal upload here --}}
    @include('shared.upload')




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

                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-default text-capitalize" data-toggle="modal" data-target="#upload-modal"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload New File</a>
                    <a class="btn btn-default text-capitalize"><i class="fa fa-plus"></i>&nbsp;&nbsp;New Folder</a>
                </div>
            </div>
        </div>
    </div>
@endsection
