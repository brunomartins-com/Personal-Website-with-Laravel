@extends('admin.sidebar-template')

@section('title', 'Order Projects Gallery | ')

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
                    <li>Update Order</li>
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
                <h3 class="block-title">Update Order</h3>
            </div>
            <div class="block-content">
                <div class="block-content block-content-full">
                    <div class="alert alert-success alert-dismissable hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span></span>
                    </div>

                    <!-- For more info and examples you can check out https://jqueryui.com/sortable/ -->
                    <div class="row js-draggable-items">
                        <div class="col-sm-12 draggable-column">
                            {!! Form::open([
                                'id' => 'formOrder',
                                'class' => 'form-horizontal'
                                ])
                            !!}
                            {!! Form::hidden('databaseTable', 'projectsGallery') !!}
                            {!! Form::hidden('primaryKey', 'projectsGalleryId') !!}
                            {!! Form::hidden('sortorder', '') !!}
                            @foreach($galleries as $gallery)
                            <!-- Block -->
                            <div class="block draggable-item" title="{{ $gallery->projectsGalleryId }}">
                                <div class="block-header">
                                    <ul class="block-options">
                                        <li>
                                            <span class="draggable-handler text-gray"><i class="si si-cursor-move"></i></span>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">
                                        <img src="{{ asset('assets/images/_upload/projects/'.$project->projectsId.'/'.$gallery->image) }}" height="100" alt="{{ $gallery->label }}" />
                                    </h3>
                                </div>
                            </div>
                            <!-- END Block -->
                            @endforeach
                            <div class="form-group">
                                <div class="col-xs-12 push-30-t">
                                    {!! Form::button('Done', ['class'=>'btn btn-success btn-back pull-left', 'data-url'=>route('projectsGallery', $project->projectsId)]) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- END Draggable Items with jQueryUI -->
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@section('javascript')
@parent
<!-- Page JS Plugins -->
<script src="{{ asset('assets/admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/sortorder.js') }}"></script>
<script>
$(function () {
    // Init page helpers (jQueryUI)
    App.initHelpers('draggable-items');
});
</script>
@stop
