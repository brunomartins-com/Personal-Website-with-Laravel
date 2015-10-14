
<!DOCTYPE html>
<html lang="en" class="loginHtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafetyBeat</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="/css/mainStyle.css" rel="stylesheet">
</head>
<body class="loginBody">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-8 loginMain">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <img src="/img/safetybeat_logo.png" class="img-responsive loginLogo">
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4>Recovery Password</h4>
            <br/>
            {!! Form::open(['url' => url('send-recovery'), 'class' => 'form-horizontal', 'method'=>'post']) !!}
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="email" type="email" required class="form-control input-lg login" placeholder="Email" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button id="forgot" type="submit" class="btn btn-primary btn-lg btn-block login">Send Recovery</button>
                    </div>
                </div>
            {!! Form::close() !!}
            <br />
        </div>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end .content > .row-->
</div> <!-- end containter -->
<script type="text/javascript" src="/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>