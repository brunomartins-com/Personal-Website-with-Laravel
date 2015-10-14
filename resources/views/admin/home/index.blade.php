@extends('admin.sidebar-template')

@section('title', 'Welcome to ')

@section('page-content')
@parent
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-8">
                    <h1 class="page-heading">
                        Start
                    </h1>
                </div>
                <div class="col-sm-4 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Start</li>
                        <li>Welcome to Bruno Martins</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->
    </main>
    <!-- END Main Container -->
@stop