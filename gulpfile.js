var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

 // WEBSITE
 //mix.copy( "resources/assets/images/**", "public/assets/images/");
 mix.sass(['main.scss'], 'public/assets/css/main.css');
 //mix.scripts(['bootstrap.js'], 'public/assets/js/bootstrap.js');
 mix.scripts(['jquery.validate.min.js','validateContact.js'], 'public/assets/js/validateContact.js');
 mix.scripts(['jquery.min.js', 'bootstrap.js', 'pageslide.js', 'custom.js'], 'public/assets/js/main.js');

 // ADMIN
 mix.styles([
      '../../../resources/assets/admin/css/bootstrap.min.css',
      '../../../resources/assets/admin/css/slick.min.css',
      '../../../resources/assets/admin/css/slick-theme.min.css',
      '../../../resources/assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.css',
      '../../../resources/assets/admin/css/bootstrap-fileupload.css',
      '../../../resources/assets/admin/css/cropper.css'
     ],
     'public/assets/admin/css/vendor.css');

 mix.less('../../../resources/assets/admin/less/main.less', 'public/assets/admin/css/main.css');

 mix.copy( "../../../resources/assets/admin/fonts/**", "public/assets/admin/fonts");
 mix.copy( "../../../resources/assets/admin/img/**", "public/assets/admin/img");
 mix.copy( "../../../resources/assets/admin/js/**", "public/assets/admin/js");

 mix.scripts([
      '../../../resources/assets/admin/js/core/jquery.min.js',
      '../../../resources/assets/admin/js/core/bootstrap.min.js',
      '../../../resources/assets/admin/js/core/jquery.slimscroll.min.js',
      '../../../resources/assets/admin/js/core/jquery.scrollLock.min.js',
      '../../../resources/assets/admin/js/core/jquery.appear.min.js',
      '../../../resources/assets/admin/js/core/jquery.countTo.min.js',
      '../../../resources/assets/admin/js/core/jquery.placeholder.min.js',
      '../../../resources/assets/admin/js/core/js.cookie.min.js',
      '../../../resources/assets/admin/js/core/slick.min.js',
      '../../../resources/assets/admin/js/core/jquery.validate.min.js',
      '../../../resources/assets/admin/js/plugins/bootbox/bootbox.min.js',
      '../../../resources/assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.js',
      '../../../resources/assets/admin/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
      '../../../resources/assets/admin/js/plugins/cropper/cropper.js',
      '../../../resources/assets/admin/js/core/custom.js'
     ],
     'public/assets/admin/js/vendor.js');

 mix.scripts(['../../../resources/assets/admin/js/app.js'], 'public/assets/admin/js/app.js');
 mix.scripts(['../../../resources/assets/admin/js/core/sortorder.js'], 'public/assets/admin/js/sortorder.js');

});