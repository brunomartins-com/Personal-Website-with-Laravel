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
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-8 loginMain text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <img src="/img/safetybeat_logo.png" class="img-responsive loginLogo">
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Email sent</div>
                <div class="panel-body">
                    We sent a email to you with a way to recovery your password.
                </div>
            </div>
            <a href="{!! url('/#login') !!}" >Return to login</a>
            <br><br>
        </div>
    </div><!-- end .content > .row-->
</div> <!-- end containter -->
<script type="text/javascript" src="/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>