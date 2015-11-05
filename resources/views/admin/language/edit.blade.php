@extends('admin.sidebar-template')

@section('title', 'Edit Language | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Languages <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('languages') }}" class="text-success" title="Languages">Languages</a></li>
                    <li>{{ $language->languageName }}</li>
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
                        <button type="button" class="btn-back" data-url="{{ route('languages') }}"><i class="si si-action-undo"></i></button>
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
                        'id' => 'languages',
                        'method' => 'put',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('languagesEdit')
                        ])
                    !!}
                    {!! Form::hidden('languageId', $language->languageId) !!}
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('languageName', 'Name *') !!}
                                {!! Form::text('languageName', $language->languageName, ['class'=>'form-control', 'id'=>'name', 'maxlength'=>45]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('write', 'Write *') !!}
                                {!! Form::select('write', $languageLevels, $language->write, ['id' => 'write', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('read', 'Read *') !!}
                                {!! Form::select('read', $languageLevels, $language->read, ['id' => 'read', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('speak', 'Speak *') !!}
                                {!! Form::select('speak', $languageLevels, $language->speak, ['id' => 'speak', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('listen', 'Listen *') !!}
                                {!! Form::select('listen', $languageLevels, $language->listen, ['id' => 'listen', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            {!! Form::label('flag', 'Flag') !!}
                            <div class="clearfix"></div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new" style="max-width:{{ $imageDetails['flagWidth'] }}px; max-height:{{ $imageDetails['flagHeight'] }};">
                                    <img src="{!! url($imageDetails['folder'].$language->flag)."?".time() !!}" alt="{{ $language->languageName }}" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:{{ $imageDetails['flagWidth'] }}px; max-height:{{ $imageDetails['flagHeight'] }}; border: 0; padding: 0; border-radius: 0;"></div>
                                <div class="font-size-10 push-10-t">Size: {{ $imageDetails['flagWidth']." x ".$imageDetails['flagHeight'] }} pixels / Types: .png, .gif or .jpg</div>
                                <div class="push-20-t">
                                    <span class="btn btn-success btn-xs btn-file">
                                        <span class="fileupload-new">Select Flag</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::hidden('currentFlag', $language->flag) !!}
                                        {!! Form::file('flag', ['id'=>'flag', 'accept'=>'image/png,image/gif,image/jpeg']) !!}
                                    </span>
                                    <a href="#" class="btn btn-inverse btn-xs fileupload-exists" data-dismiss="fileupload" style="margin-left: 30px;">Cancel</a>
                                </div>
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

@section('javascript')
@parent
<script type="text/javascript">
$(function(){
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
            'languageName': {
                required: true
            },
            'write': {
                required: true
            },
            'read': {
                required: true
            },
            'speak': {
                required: true
            },
            'listen': {
                required: true
            }
        }
    });
});
</script>
@stop
