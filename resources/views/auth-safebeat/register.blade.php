@extends('template.base')

@section('content')
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Register Block -->
            <div class="block block-themed animated fadeIn">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <a href="{!! url('login') !!}"  title="Log In"><i class="si si-login"></i> Login</a>
                        </li>
                    </ul>
                    <h3 class="block-title">Register</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <img alt="safety beat logo" class="center-block" width="80%"
                         src="{{ asset('assets/img/safetybeat_logo.png') }}">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="js-validation-register form-horizontal push-50-t push-50" action="{!! url('register') !!}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" id="email" name="email" placeholder="Please enter a email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Choose a password..">
                                    <label for='password'>Password</label>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="..and confirm it">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" id="firstName" name="firstName" placeholder="Type your first name">
                                    <label for="firstName">First Name</label>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" id="lastName" name="lastName" placeholder="Type your last name">
                                    <label for="lastName">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="Type you Phone">
                                    <label for="phone">Phone</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-5">
                                <button class="btn btn-block btn-primary" type="submit"><i class="fa fa-plus pull-right"></i> Sign Up</button>
                            </div>
                        </div>
                    </form><!-- END Register Form -->
                </div>
            </div><!-- END Register Block -->
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="application/javascript">
$(function(){
    $('.js-validation-register').validate({
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
            },
            'password_confirmation': {
                required: true,
                equalTo: '#password'
            },
            'firstName': {
                required: true,
                minlength: 2
            },
            'lastName': {
                required: true,
                minlength: 2
            },
            'phone': {
                required: true,
                minlength: 8
            }
        },
        messages: {
            'email': {
                required: 'Please enter a email'
            },
            'password': {
                required: 'Provide a password'
            },
            'password_confirmation': {
                required: 'Provide a password',
                equalTo: 'Please enter the same password as above'
            },
            'firstName': {
                required: 'Enter your last name',
                minlength: 'Your first name must be at least 2 characters long'
            },
            'lastName': {
                required: 'Enter your fist name',
                minlength: 'Your last name must be at least 2 characters long'
            },
            'phone': {
                required: 'Enter your phone',
                minlength: 'Your phone must be at least 8 characters long'
            }
        }
    });
});
</script>
@stop