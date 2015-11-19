<!DOCTYPE html>
<html lang="en">
<head></head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
    <img src="{{ url('assets/images/_upload/websiteSettings/logo-brunomartins.png') }}" alt="Bruno Martins Full Stack Web Developer" />
    <br />
    <h3>Contact the website</h3>
    <br />
    <hr />
    <br />
    <strong>Name: </strong> {{ $request->name }}
    <br />
    <strong>Email:</strong> {{ $request->email }}
    <br />
    <strong>Phone/Mobile: </strong> {{ $request->phone }}
    <br />
    <strong>Message: </strong> {!! nl2br(e($request->message)) !!}
    <br /><br />

    <br />
    <strong>Internet user's IP: {{ $request->ip() }}</strong>
    <br />
    <strong>Data sent in: {{ $request->date }}</strong>
</body>
</html>