@extends('admin.sidebar-template')

@section('title', 'Edit Project Gallery | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Projects - Gallery <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('projects') }}" class="text-success" title="Projects">Projects</a></li>
                    <li><a href="{{ route('projectsEdit', $project->projectsId) }}" class="text-success" title="{{ $project->title }}">{{ $project->title }}</a></li>
                    <li><a href="{{ route('projectsGallery', $project->projectsId) }}" class="text-success" title="Gallery">Gallery</a></li>
                    <li>Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-gray-darker text-white">
                <ul class="block-options">
                    <li>
                        <button type="button" class="btn-back" data-url="{{ route('projects') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" class="btn-back" data-url="{{ route('projectsGallery', $project->projectsId) }}"><i class="si si-control-start"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Edit</h3>
            </div>
            <div class="block-content">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- .block-content -->
                <div class="block-content block-content-full">
                    {!! Form::open([
                        'id' => 'projectsGallery',
                        'method' => 'put',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('projectsGalleryEditPut')
                        ])
                    !!}
                    {!! Form::hidden('projectsId', $project->projectsId) !!}
                    {!! Form::hidden('projectsGalleryId', $projectGallery->projectsGalleryId) !!}
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('label', 'Label') !!}
                                {!! Form::text('label', $projectGallery->label, ['class'=>'form-control', 'id'=>'label', 'maxlength'=>100]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('image', 'Image') !!}
                                <br />
                                <img src="{{ asset('assets/images/_upload/projects/'.$project->projectsId.'/'.$projectGallery->image) }}" height="200" alt="{{ $projectGallery->label }}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 push-30-t">
                            {!! Form::submit('Save', ['class'=>'btn btn-success pull-left']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop