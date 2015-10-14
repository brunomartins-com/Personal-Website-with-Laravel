<!DOCTYPE html>
<html lang="en" class="loginHtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafetyBeat - Password Recovery</title>
</head>
<body style="background-color:#F5F5F5">
<div style="width: 100%; float: left; clear: both; text-align: center; margin: auto">
    <div style="margin: 0 auto;">
        <div style="width:50%; height: 100%; min-height: 100%; margin-top: 40px; border: 2px solid #428bca; display: block; background-color: #fff;">
            <div style="margin: 0 auto;">
                <div style="width: 60%; margin: 0 20%;">
                    <img src="{!! url('/assets/img/safetybeat_logo.png') !!}" style="max-width: 100%; margin: 10px auto">
                </div>
            </div>
            <h4 style="font-size: 18px;">Hi {{ $user->firstName  }}</h4>
            <p>This email has set for our forgot password, to complete your request <a href="{{ url('recovery-password/'.$token) }}">click here</a></p>
            <br><br>
        </div>
    </div><!-- end .row -->
</div><!-- end .containter -->
</body>
</html>