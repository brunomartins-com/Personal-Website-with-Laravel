@extends('admin.sidebar-template')

@section('title', 'Website Settings | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Website Settings <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Website Settings</li>
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
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Edit</h3>
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
                <!-- .block-content -->
                <div class="block-content block-content-full">
                    {!! Form::open([
                            'id' => 'websiteSettings',
                            'method' => 'put',
                            'class' => 'form-horizontal push-20-t',
                            'enctype' => 'multipart/form-data',
                            'url' => route('websiteSettings')
                            ])
                    !!}
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('title', 'Title *') !!}
                                {!! Form::text('title', $websiteSettings->title, ['class'=>'form-control', 'id'=>'title', 'maxlength'=>50]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('description', 'Description *') !!}
                                {!! Form::text('description', $websiteSettings->description, ['class'=>'form-control', 'id'=>'description', 'maxlength'=>200]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('keywords', 'Keywords *') !!}
                                {!! Form::textarea('keywords', $websiteSettings->keywords, ['class'=>'js-tags-input form-control', 'rows' => '6', 'id'=>'keywords']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::label('phone', 'Phone') !!}
                                    {!! Form::text('phone', $websiteSettings->phone, ['class'=>'form-control', 'id'=>'phone', 'maxlength'=>20]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-input">
                                        {!! Form::label('email', 'Email *') !!}
                                        {!! Form::text('email', $websiteSettings->email, ['class'=>'form-control', 'id'=>'email', 'maxlength'=>50]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::label('city', 'City') !!}
                                    {!! Form::text('city', $websiteSettings->city, ['class'=>'form-control', 'id'=>'city', 'maxlength'=>50]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::label('state', 'State') !!}
                                    {!! Form::text('state', $websiteSettings->state, ['class'=>'form-control', 'id'=>'state', 'maxlength'=>2]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::label('country', 'Country') !!}
                                    {!! Form::text('country', $websiteSettings->country, ['class'=>'form-control', 'id'=>'country', 'maxlength'=>50]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::label('instagram', 'Instagram') !!}
                                    {!! Form::text('instagram', $websiteSettings->instagram, ['class'=>'form-control', 'id'=>'instagram', 'placeholder'=>'http://', 'maxlength'=>255]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::label('linkedin', 'Linkedin') !!}
                                    {!! Form::text('linkedin', $websiteSettings->linkedin, ['class'=>'form-control', 'id'=>'linkedin', 'placeholder'=>'http://', 'maxlength'=>255]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            {!! Form::label('currentLogotype', 'Logotype') !!}
                            <div class="clearfix"></div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new" style="max-width:{{ $imagesSize['logotypeWidth'] }}px; max-height:{{ $imagesSize['logotypeHeight'] }}px;">
                                    <img src="{!! url('assets/images/_upload/websiteSettings/'.$websiteSettings->logotype) !!}" alt="{{ $websiteSettings->title }}" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:{{ $imagesSize['logotypeWidth'] }}px; max-height:{{ $imagesSize['logotypeHeight'] }}px; border: 0; padding: 0; border-radius: 0;"></div>
                                <div class="font-size-10 push-10-t">Size: {{ $imagesSize['logotypeWidth']." x ".$imagesSize['logotypeHeight'] }} pixels</div>
                                <div class="push-20-t">
                                    <span class="btn btn-success btn-xs btn-file">
                                        <span class="fileupload-new">Change</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::hidden('currentLogotype', $websiteSettings->logotype) !!}
                                        {!! Form::file('logotype', ['id'=>'logotype']) !!}
                                    </span>
                                    <a href="#" class="btn btn-success btn-xs fileupload-exists" data-dismiss="fileupload" style="margin-left: 30px;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            {!! Form::label('currentFavicon', 'Favicon') !!}
                            <div class="clearfix"></div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new" style="max-width:{{ $imagesSize['faviconWidth'] }}px; max-height:{{ $imagesSize['faviconHeight'] }};">
                                    <img src="{!! url('assets/images/_upload/websiteSettings/'.$websiteSettings->favicon)."?".time() !!}" alt="{{ $websiteSettings->title }}" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:{{ $imagesSize['faviconWidth'] }}px; max-height:{{ $imagesSize['faviconHeight'] }}; border: 0; padding: 0; border-radius: 0;"></div>
                                <div class="font-size-10 push-10-t">Size: {{ $imagesSize['faviconWidth']." x ".$imagesSize['faviconHeight'] }} pixels / Format: .png or .gif</div>
                                <div class="push-20-t">
                                    <span class="btn btn-success btn-xs btn-file">
                                        <span class="fileupload-new">Change</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::hidden('currentFavicon', $websiteSettings->favicon) !!}
                                        {!! Form::file('favicon', ['class'=>'form-control', 'id'=>'favicon', 'accept'=>'image/png,image/gif']) !!}
                                    </span>
                                    <a href="#" class="btn btn-success btn-xs fileupload-exists" data-dismiss="fileupload" style="margin-left: 30px;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            {!! Form::label('currentAvatar', 'Avatar') !!}
                            <div class="clearfix"></div>
                            <div class="img-container hidden">
                                <img />
                            </div>
                            <div class="img-current">
                                <img src="{!! url('assets/images/_upload/websiteSettings/'.$websiteSettings->avatar)."?".time() !!}" alt="{{ $websiteSettings->title }}" />
                            </div>
                            <div class="font-size-10 push-10-t">Size: {{ $imagesSize['avatarWidth']." x ".$imagesSize['avatarHeight'] }} pixels</div>
                            <br>
                            <label class="btn btn-success btn-xs btn-upload" for="avatar" title="Upload image file">
                                {!! Form::hidden('currentAvatar', $websiteSettings->avatar) !!}
                                {!! Form::hidden('avatarPositionX', '') !!}
                                {!! Form::hidden('avatarPositionY', '') !!}
                                {!! Form::hidden('avatarCropAreaW', '') !!}
                                {!! Form::hidden('avatarCropAreaH', '') !!}
                                {!! Form::file('avatar', ['class'=>'sr-only', 'id'=>'avatar', 'accept'=>'image/*', 'data-crop'=>true]) !!}
                                <span class="docs-tooltip" title="Upload image file">Change</span>
                            </label>
                            <label class="btn btn-success btn-xs btn-cancel-upload hidden" title="Cancel">Cancel</label>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            {!! Form::label('currentAppleTouchIcon', 'Apple Touch Icon') !!}
                            <div class="clearfix"></div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new" style="max-width:{{ $imagesSize['appleTouchIconWidth'] }}px; max-height:{{ $imagesSize['appleTouchIconHeight'] }}px;">
                                    <img src="{!! url('assets/images/_upload/websiteSettings/'.$websiteSettings->appleTouchIcon)."?".time() !!}" alt="{{ $websiteSettings->title }}" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:{{ $imagesSize['appleTouchIconWidth'] }}px; max-height:{{ $imagesSize['appleTouchIconHeight'] }}px; border-radius: 0; border:0; padding: 0;"></div>
                                <div class="font-size-10 push-10-t">Size: {{ $imagesSize['appleTouchIconWidth']." x ".$imagesSize['appleTouchIconHeight'] }} pixels / Only .png</div>
                                <div class="push-20-t">
                                    <span class="btn btn-success btn-xs btn-file">
                                        <span class="fileupload-new">Change</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::hidden('currentAppleTouchIcon', $websiteSettings->appleTouchIcon) !!}
                                        {!! Form::file('appleTouchIcon', ['id'=>'appleTouchIcon', 'accept'=>'image/png']) !!}
                                    </span>
                                    <a href="#" class="btn btn-success btn-xs fileupload-exists" data-dismiss="fileupload" style="margin-left: 30px;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 push-30-t">
                            <!--if(App\ACL::hasPermission('permissionsCenterGroup', 'add'))-->
                            {!! Form::submit('Save', ['class'=>'btn btn-success pull-left']) !!}
                            <!--endif-->
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
<script src="{{ asset('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script type="application/javascript">
$(function(){
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
            'description': {
                required: true
            },
            'keywords': {
                required: true
            },
            'email': {
                required: true,
                email: true
            }
        },
        messages: {
            'title': {
                required: 'Please enter a website title'
            },
            'description': {
                required: 'Please enter a website description'
            },
            'keywords': {
                required: 'Please enter a website keywords'
            },
            'email': {
                required: 'Please enter a email'
            }
        }
    });
});
$('.img-container > img').cropper({
    aspectRatio: <?=($imagesSize['avatarWidth'])/($imagesSize['avatarHeight']);?>,
    autoCropArea: 1,
    minContainerWidth:<?=$imagesSize['avatarWidth'];?>,
    minContainerHeight:<?=$imagesSize['avatarHeight'];?>,
    minCropBoxWidth:<?=$imagesSize['avatarWidth'];?>,
    minCropBoxHeight:<?=$imagesSize['avatarHeight'];?>,
    mouseWheelZoom:false,
    crop: function(e) {
        $("input[name=avatarPositionX]").val(Math.round(e.x));
        $("input[name=avatarPositionY]").val(Math.round(e.y));
        $("input[name=avatarCropAreaW]").val(Math.round(e.width));
        $("input[name=avatarCropAreaH]").val(Math.round(e.height));
    }
});
$('.btn-cancel-upload').click(function(){
    $('.btn-upload').removeClass('hidden');
    $('.btn-cancel-upload').addClass('hidden');
    $('.img-current').removeClass('hidden');
    $('.img-container > img').attr('src', '');
    $('.img-container').addClass('hidden');
    $('input[type=file]#avatar').val('');
});
$(function () {
    var $image = $('.img-container > img');
    // Import image
    var $inputImage = $('input[type=file]#avatar');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            $('.btn-upload').addClass('hidden');
            $('.btn-cancel-upload').removeClass('hidden');
            $('.img-current').addClass('hidden');
            $('.img-container').removeClass('hidden');

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
    // Init page helper (Tags Inputs plugin)
    App.initHelpers(['tags-inputs']);
});
</script>
@stop
