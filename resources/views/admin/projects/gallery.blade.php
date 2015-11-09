@extends('admin.sidebar-template')

@section('title', 'Project Gallery | ')

@section('head')
@parent
{!! Html::style(asset('assets/admin/js/plugins/dropzonejs/dropzone.css')) !!}
@stop

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
                    <li>Gallery</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li>
                        <button type="button" class="btn-back" data-url="{{ route('projects') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">
                    @if(count($projectGallery) > 0)
                    {!! Form::button('<i class="fa fa-plus"></i> Add More', ['class'=>'btn btn-success btn-add push-10-r', 'onclick'=>'$(\'.addMore\').removeClass(\'hide\'); $(\'.btn-add\').addClass(\'hide\');']) !!}
                    {!! Form::button('<i class="fa fa-list"></i> Update Order', ['class'=>'btn btn-inverse', 'onclick'=>'window.open(\''.route('projectsGalleryOrder', $project->projectsId).'\', \'_self\');']) !!}
                    @else
                    Send your first image
                    @endif
                </h3>
            </div>
            <div class="block-content">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {!! Session::get('success') !!}
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="addMore @if(count($projectGallery) > 0) hide @endif push-15-b">
                    {!! Form::open([
                        'id' => 'my-dropzone',
                        'url' => route('projectsGalleryAdd'),
                        'class' => 'dropzone',
                        'method' => 'post',
                        'file' => true
                    ]) !!}
                    {!! Form::close() !!}
                </div>
                <div class="row items-push">
                    @foreach($projectGallery as $gallery)
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 animated fadeIn">
                        <div class="img-container fx-img-zoom-in">
                            <img class="img-responsive" src="/{{ $imageDetails['folder'].$project->projectsId."/".$gallery->image }}" alt="{{ $gallery->label }}" />
                            <div class="img-options">
                                <div class="img-options-content">
                                    <h3 class="font-w400 text-white push-5">{{ $gallery->label }}</h3>
                                    <a class="btn btn-xs btn-primary" href="{{ route('projectsGalleryEdit', [$project->projectsId, $gallery->projectsGalleryId]) }}"><i class="fa fa-pencil"></i></a>

                                    {!! Form::open([
                                        'id'=>'formDelete'.$gallery->projectsGalleryId,
                                        'style' => 'display: inline-block;',
                                        'method' => 'delete',
                                        'enctype' => 'multipart/form-data',
                                        'url' => route('projectsGalleryDelete')
                                        ])
                                    !!}
                                    {!! Form::hidden('projectsId', $project->projectsId) !!}
                                    {!! Form::hidden('projectsGalleryId', $gallery->projectsGalleryId) !!}
                                    {!! Form::hidden('image', $gallery->image) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['title'=>'Delete', 'class'=>'btn btn-xs btn-danger btn-delete',
                                                     'data-url'=>route('projectsGalleryDelete'), 'data-form'=>true, 'data-id-form'=>'formDelete'.$gallery->projectsGalleryId]) !!}


                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- END Image Zoom In -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@section('javascript')
@parent
{!! Html::script(asset('assets/admin/js/plugins/dropzonejs/dropzone.min.js')) !!}
<script type="text/javascript">
$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
});
//DROPZONE MULTIPLE UPLOAD
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#my-dropzone", {
    url: "{{ route('projectsGalleryAdd') }}",
    params: {
        _token: $('input[name=_token]').val(),
        projectsId: {{ $project->projectsId }}
    },
    paramName:"file",
    uploadMultiple: true,
    maxFilesize: 2,
    maxFiles: 10,
    parallelUploads: 1,
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    init: function(){
        this.on('queuecomplete', function () {
            location.reload();
        });
    }
});
</script>
@stop