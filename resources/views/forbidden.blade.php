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

                        <h2><i class="fa fa-ban"></i>&nbsp;&nbsp;Forbidden</h2>
                        <p>Sorry, you don't have access to this page.</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection