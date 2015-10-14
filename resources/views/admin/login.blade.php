@extends('template.base')

@section('content')
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Login Block -->
            <div class="block block-themed animated fadeIn">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <a href="{{ route('passwordEmail') }}" title="Recover Password"><i class="si si-lock-open"></i> Forgot Password?</a>
                        </li>
                    </ul>
                    <h3 class="block-title">Login</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <img src="{{ asset('assets/admin/img/logoBrunoMartinsLogin.png') }}" width="80%" class="center-block" alt="Bruno Martins - Web Developer" />
                    @if (Session::has('recovered'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {!! Session::get('recovered') !!}
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
                    <form class="js-validation-login form-horizontal push-50-t push-50" action="{!! route('login') !!}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" placeholder="Enter your email" id="email" value="{{ old('email') }}" name="email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="password" placeholder="Enter your password" id="password" name="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                             <div class="col-xs-12">
                                 <label class="css-input switch switch-sm switch-primary">
                                     <input type="checkbox" id="remember" name="remember"><span></span> Remember Me?
                                 </label>
                             </div>
                         </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <button class="btn btn-block btn-primary" type="submit"><i class="si si-login pull-right"></i>Log in</button>
                            </div>
                        </div>
                    </form><!-- END Login Form -->
                </div>
            </div><!-- END Login Block -->
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="application/javascript">
$(function(){
    $('.js-validation-login').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group .form-material').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        rules: {
            'email': {
                required: true,
                email: true
            },
            'password': {
                required: true
            }
        },
        messages: {
            'email': {
                required: 'Please enter a email'
            },
            'password': {
                required: 'Please provide a password'
            }
        }
    });
});
</script>
@stop