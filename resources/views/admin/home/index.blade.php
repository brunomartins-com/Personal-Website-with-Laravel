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

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Full -->
            <div class="block">
                @if (count($errors) > 0)
                <div class="block-content">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@stop