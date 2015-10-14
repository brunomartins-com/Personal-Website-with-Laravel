@extends('template.base')

@section('content')
    <div class="content overflow-hidden">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <!-- Register Block -->
                <div class="block block-themed animated fadeIn">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Password Recovery</h3>
                    </div>
                    <div class="block-content block-content-full block-content-narrow">
                        <img alt="safety beat logo" class="center-block" width="80%"
                             src="{{ asset('assets/img/safetybeat_logo.png' )}}">

                        @if (Session::has('status'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {!! Session::get('status') !!}
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

                        <form class="js-validation-recovery form-horizontal push-50-t push-50" action="{!! url('recovery-password') !!}" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}" >

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-primary">
                                        <input class="form-control" type="email"  id="email" name="email"  value="{{ old('email') }}" placeholder="Enter your password..">
                                        <label for='email'>Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-primary">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Choose a password..">
                                        <label for='password'>Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-primary">
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="..and confirm it">
                                        <label for="password_confirmation">Confirm Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <button class="btn btn-block btn-primary" type="submit"><i class="fa fa-save pull-right"></i> Save Change</button>
                                </div>
                            </div>
                        </form><!-- END Recovery Form -->
                    </div>
                </div><!-- END Recovery Block -->
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="application/javascript">
        $(function(){
            $('.js-validation-recovery').validate({
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
                    }
                },
                messages: {
                    'email': {
                        required: 'Enter a email'
                    },
                    'password': {
                        required: 'Provide a password'
                    },
                    'password_confirmation': {
                        required: 'Provide a password',
                        equalTo: 'Please enter the same password as above'
                    }
                }
            });
        });
    </script>
@stop