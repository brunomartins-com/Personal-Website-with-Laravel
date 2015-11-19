@extends('admin.sidebar-template')

@section('title', 'Add Project | ')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
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
                    Projects <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('projects') }}" class="text-success" title="Projects">Projects</a></li>
                    <li>Add</li>
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
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Add</h3>
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
                        'id' => 'projects',
                        'method' => 'post',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('projectsAdd')
                        ])
                    !!}
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('title', 'Title *') !!}
                                {!! Form::text('title', '', ['class'=>'form-control', 'id'=>'title', 'maxlength'=>50]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('projectsTypeId', 'Type *', ['style' => 'width:100%; float:left; clear:both;']) !!}
                                <div class="boxSelectTypes">{!! Form::select('projectsTypeId', $projectsType, '', ['id' => 'projectsTypeId', 'class' => 'form-control', 'style' => 'width:80%; float:left;']) !!}</div>
                                {!! Form::button('<i class="fa fa-wrench"></i>', ['id' => 'btnSelectTypes', 'class' => 'btn btn-xs btn-inverse', 'style' => 'margin:5px 0 0 10px;',
                                                 'data-toggle' => 'modal', 'href' => '#modalSelectTypes']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('projectDate', 'ProjectDate *') !!}
                                {!! Form::text('projectDate', '', ['class'=>'js-datepicker js-masked-date form-control', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy',
                                               'id'=>'projectDate', 'maxlength'=>10]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('client', 'Client *') !!}
                                {!! Form::text('client', '', ['class'=>'form-control', 'id'=>'client', 'maxlength'=>50]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('agency', 'Agency *') !!}
                                {!! Form::text('agency', '', ['class'=>'form-control', 'id'=>'agency', 'maxlength'=>50]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('url', 'URL') !!}
                                {!! Form::text('url', '', ['class'=>'form-control', 'id'=>'url', 'placeholder'=>'Without http://', 'maxlength'=>255]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('description', 'Description *') !!}
                                {!! Form::textarea('description', '', ['class'=>'form-control', 'id'=>'description']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('tags', 'Tags *') !!}
                                {!! Form::textarea('tags', '', ['class'=>'js-tags-input form-control', 'rows' => '6', 'id'=>'tags']) !!}
                            </div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group largeImage">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {!! Form::label('largeImage', 'Large Image') !!}
                            <div class="clearfix"></div>
                            <div class="img-container hidden">
                                <img />
                            </div>
                            <div class="img-current">
                                <img src="http://placehold.it/{{ $imageDetails['largeWidth'] }}x{{ $imageDetails['largeHeight'] }}" alt="Add Project" />
                            </div>
                            <div class="font-size-10 push-10-t">Size: {{ $imageDetails['largeWidth']." x ".$imageDetails['largeHeight'] }} pixels</div>
                            <br>
                            <label class="btn btn-success btn-xs btn-upload" for="largeImage" title="Select Image">
                                {!! Form::hidden('largePositionX', '') !!}
                                {!! Form::hidden('largePositionY', '') !!}
                                {!! Form::hidden('largeCropAreaW', '') !!}
                                {!! Form::hidden('largeCropAreaH', '') !!}
                                {!! Form::file('largeImage', ['class'=>'sr-only form-control', 'id'=>'largeImage', 'accept'=>'image/*', 'data-crop'=>true]) !!}
                                <span class="docs-tooltip" title="Select Image">Select Image</span>
                            </label>
                            <label class="btn btn-success btn-xs btn-cancel-upload hidden" title="Cancel">Cancel</label>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group mediumImage">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {!! Form::label('mediumImage', 'Medium Image') !!}
                            <div class="clearfix"></div>
                            <div class="img-container hidden">
                                <img />
                            </div>
                            <div class="img-current">
                                <img src="http://placehold.it/{{ $imageDetails['mediumWidth'] }}x{{ $imageDetails['mediumHeight'] }}" alt="Add Project" />
                            </div>
                            <div class="font-size-10 push-10-t">Size: {{ $imageDetails['mediumWidth']." x ".$imageDetails['mediumHeight'] }} pixels</div>
                            <br>
                            <label class="btn btn-success btn-xs btn-upload" for="mediumImage" title="Select Image">
                                {!! Form::hidden('mediumPositionX', '') !!}
                                {!! Form::hidden('mediumPositionY', '') !!}
                                {!! Form::hidden('mediumCropAreaW', '') !!}
                                {!! Form::hidden('mediumCropAreaH', '') !!}
                                {!! Form::file('mediumImage', ['class'=>'sr-only form-control', 'id'=>'mediumImage', 'accept'=>'image/*', 'data-crop'=>true]) !!}
                                <span class="docs-tooltip" title="Select Image">Select Image</span>
                            </label>
                            <label class="btn btn-success btn-xs btn-cancel-upload hidden" title="Cancel">Cancel</label>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group smallImage">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {!! Form::label('smallImage', 'Small Image') !!}
                            <div class="clearfix"></div>
                            <div class="img-container hidden">
                                <img />
                            </div>
                            <div class="img-current">
                                <img src="http://placehold.it/{{ $imageDetails['smallWidth'] }}x{{ $imageDetails['smallHeight'] }}" alt="Add Project" />
                            </div>
                            <div class="font-size-10 push-10-t">Size: {{ $imageDetails['smallWidth']." x ".$imageDetails['smallHeight'] }} pixels</div>
                            <br>
                            <label class="btn btn-success btn-xs btn-upload" for="smallImage" title="Select Image">
                                {!! Form::hidden('smallPositionX', '') !!}
                                {!! Form::hidden('smallPositionY', '') !!}
                                {!! Form::hidden('smallCropAreaW', '') !!}
                                {!! Form::hidden('smallCropAreaH', '') !!}
                                {!! Form::file('smallImage', ['class'=>'sr-only form-control', 'id'=>'smallImage', 'accept'=>'image/*', 'data-crop'=>true]) !!}
                                <span class="docs-tooltip" title="Select Image">Select Image</span>
                            </label>
                            <label class="btn btn-success btn-xs btn-cancel-upload hidden" title="Cancel">Cancel</label>
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
<div id="modalSelectTypes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
@stop

@section('javascript')
@parent
<script src="{{ asset('assets/admin/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/admin/editor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(function(){
    //START CKEDITOR CODE
    CKEDITOR.replace('description');
    //START VALIDATE FORM CODE
    $('.form-horizontal').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group .form-input').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        ignore: [],
        rules: {
            'title': {
                required: true
            },
            'projectsTypeId': {
                required: true
            },
            'projectDate': {
                required: true
            },
            'client': {
                required: true
            },
            'description': {
                required: function()
                {
                    CKEDITOR.instances.description.updateElement();
                }
            },
            'tags': {
                required: true
            },
            'largeImage': {
                required: true
            },
            'mediumImage': {
                required: true
            },
            'smallImage': {
                required: true
            }
        }
    });
    // Init page helpers (BS Datepicker + Masked Input + Tags Input)
    App.initHelpers(['datepicker', 'masked-inputs', 'tags-inputs']);

    //OPEN MODAL FOR ADD CATEGORIES
    $('#btnSelectTypes').click(function(){
        var modal = $(this).attr('href');
        console.log(modal);
        $(modal).load('{{ route('selectCategory', ['Types', 'SelectTypes', 'projectsType']) }}',function(result){
            $(modal).modal({show:true});
        });
    });
});
//LARGE IMAGE
$('.largeImage .img-container > img').cropper({
    aspectRatio: <?=($imageDetails['largeWidth'])/($imageDetails['largeHeight']);?>,
    autoCropArea: 1,
    minContainerWidth:<?=$imageDetails['largeWidth'];?>,
    minContainerHeight:<?=$imageDetails['largeHeight'];?>,
    minCropBoxWidth:<?=$imageDetails['largeWidth'];?>,
    minCropBoxHeight:<?=$imageDetails['largeHeight'];?>,
    mouseWheelZoom:false,
    crop: function(e) {
        $("input[name=largePositionX]").val(Math.round(e.x));
        $("input[name=largePositionY]").val(Math.round(e.y));
        $("input[name=largeCropAreaW]").val(Math.round(e.width));
        $("input[name=largeCropAreaH]").val(Math.round(e.height));
    }
});
$('.largeImage .btn-cancel-upload').click(function(){
    $('.largeImage .btn-upload').removeClass('hidden');
    $('.largeImage .btn-cancel-upload').addClass('hidden');
    $('.largeImage .img-current').removeClass('hidden');
    $('.largeImage .img-container > img').attr('src', '');
    $('.largeImage .img-container').addClass('hidden');
    $('input[type=file]#largeImage').val('');
});
$(function () {
    var $image = $('.largeImage .img-container > img');
    // Import image
    var $inputImage = $('input[type=file]#largeImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            $('.largeImage .btn-upload').addClass('hidden');
            $('.largeImage .btn-cancel-upload').removeClass('hidden');
            $('.largeImage .img-current').addClass('hidden');
            $('.largeImage .img-container').removeClass('hidden');

            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
                return;
            }

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {
                        URL.revokeObjectURL(blobURL); // Revoke when load complete
                    }).cropper('reset').cropper('replace', blobURL);
                    //$inputImage.val('');
                } else {
                    $body.tooltip('Please choose an image file.', 'warning');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
});
//MEDIUM IMAGE
$('.mediumImage .img-container > img').cropper({
    aspectRatio: <?=($imageDetails['mediumWidth'])/($imageDetails['mediumHeight']);?>,
    autoCropArea: 1,
    minContainerWidth:<?=$imageDetails['mediumWidth'];?>,
    minContainerHeight:<?=$imageDetails['mediumHeight'];?>,
    minCropBoxWidth:<?=$imageDetails['mediumWidth'];?>,
    minCropBoxHeight:<?=$imageDetails['mediumHeight'];?>,
    mouseWheelZoom:false,
    crop: function(e) {
        $("input[name=mediumPositionX]").val(Math.round(e.x));
        $("input[name=mediumPositionY]").val(Math.round(e.y));
        $("input[name=mediumCropAreaW]").val(Math.round(e.width));
        $("input[name=mediumCropAreaH]").val(Math.round(e.height));
    }
});
$('.mediumImage .btn-cancel-upload').click(function(){
    $('.mediumImage .btn-upload').removeClass('hidden');
    $('.mediumImage .btn-cancel-upload').addClass('hidden');
    $('.mediumImage .img-current').removeClass('hidden');
    $('.mediumImage .img-container > img').attr('src', '');
    $('.mediumImage .img-container').addClass('hidden');
    $('input[type=file]#mediumImage').val('');
});
$(function () {
    var $image = $('.mediumImage .img-container > img');
    // Import image
    var $inputImage = $('input[type=file]#mediumImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            $('.mediumImage .btn-upload').addClass('hidden');
            $('.mediumImage .btn-cancel-upload').removeClass('hidden');
            $('.mediumImage .img-current').addClass('hidden');
            $('.mediumImage .img-container').removeClass('hidden');

            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
                return;
            }

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {
                        URL.revokeObjectURL(blobURL); // Revoke when load complete
                    }).cropper('reset').cropper('replace', blobURL);
                    //$inputImage.val('');
                } else {
                    $body.tooltip('Please choose an image file.', 'warning');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
});
//SMALL IMAGE
$('.smallImage .img-container > img').cropper({
    aspectRatio: <?=($imageDetails['smallWidth'])/($imageDetails['smallHeight']);?>,
    autoCropArea: 1,
    minContainerWidth:<?=$imageDetails['smallWidth'];?>,
    minContainerHeight:<?=$imageDetails['smallHeight'];?>,
    minCropBoxWidth:<?=$imageDetails['smallWidth'];?>,
    minCropBoxHeight:<?=$imageDetails['smallHeight'];?>,
    mouseWheelZoom:false,
    crop: function(e) {
        $("input[name=smallPositionX]").val(Math.round(e.x));
        $("input[name=smallPositionY]").val(Math.round(e.y));
        $("input[name=smallCropAreaW]").val(Math.round(e.width));
        $("input[name=smallCropAreaH]").val(Math.round(e.height));
    }
});
$('.smallImage .btn-cancel-upload').click(function(){
    $('.smallImage .btn-upload').removeClass('hidden');
    $('.smallImage .btn-cancel-upload').addClass('hidden');
    $('.smallImage .img-current').removeClass('hidden');
    $('.smallImage .img-container > img').attr('src', '');
    $('.smallImage .img-container').addClass('hidden');
    $('input[type=file]#smallImage').val('');
});
$(function () {
    var $image = $('.smallImage .img-container > img');
    // Import image
    var $inputImage = $('input[type=file]#smallImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            $('.smallImage .btn-upload').addClass('hidden');
            $('.smallImage .btn-cancel-upload').removeClass('hidden');
            $('.smallImage .img-current').addClass('hidden');
            $('.smallImage .img-container').removeClass('hidden');

            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
                return;
            }

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {
                        URL.revokeObjectURL(blobURL); // Revoke when load complete
                    }).cropper('reset').cropper('replace', blobURL);
                    //$inputImage.val('');
                } else {
                    $body.tooltip('Please choose an image file.', 'warning');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
});
</script>
@stop
