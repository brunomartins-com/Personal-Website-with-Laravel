<!DOCTYPE html>
<html lang="en">
<head>
    <title>Web Developer | Web design HTML CSS PHP MySQL Laravel Framework JavaScript</title>
    <meta name="classification" content="Atlanta, Georgia, GA, Information and Technology: Computers and Internet: Web Design and Development">
    <meta name="geography" content="United States, Georgia, Atlanta Metro">
    <meta name="language" content="English">
    <meta name="revisit-after" content="30 days">
    <meta name="distribution" content="United States, USA, Georgia, Atlanta Metro, Atlanta">
    <meta name="country" content="United States, USA">
    <meta property="og:determiner" content="atlanta">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="pt_BR">
    <meta name="robots" content="index,follow">
    <meta name="location" content="Atlanta,Georgia">
    <meta name="rating" content="General">
    <meta name="google-site-verification" content="n0lewNheJFwC1PA6kqWnK4x0_2jDTbkIvpb3v6tteIY" />
    <meta name="description" content="Bruno Martins | Web Developer Front-End &amp; Back-End Developer in Atlanta / GA - PHP, HTML5, CSS3, JAVASCRIPT, LARAVEL FRAMEWORK AND MORE">
    <meta name="keywords" content="web design united states, web design georgia, web design atlanta, web design marietta, web design kennesaw, web design alpharetta, web programmer united states, web programmer georgia, web programmer atlanta, web programmer marietta, web programmer kenessaw, web programmer alpharetta, front-end developer, back-end developer, developer, php developer, php programmer, html programmer, css programmer, full stack, professional">
    <meta charset="utf-8">
    <meta name="author" content="Bruno Martins">
    <meta name="format-detection" content="telephone=no" />
    <meta name="ICBM" content="GA ">
    <meta name="geo.position" content="GA ">
    <meta name="geo.placename" content="Atlanta">
    <meta name="geo.region" content="us">
    <meta property="dc.title" lang="en" content="Web Developer | Web design HTML CSS PHP MySQL Laravel Framework JavaScript">
    <meta property="dc.description" lang="en" content="Bruno Martins | Web Developer Front-End &amp; Back-End Developer in Atlanta / GA - PHP, HTML5, CSS3, JAVASCRIPT, LARAVEL FRAMEWORK AND MORE">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Bruno Martins">
    <meta property="og:url" content="{{ url() }}">
    <meta property="og:title" content="Web Developer | Web design HTML CSS PHP MySQL Laravel Framework JavaScript">
    <meta property="og:description" content="Bruno Martins | Web Developer Front-End &amp; Back-End Developer in Atlanta / GA - PHP, HTML5, CSS3, JAVASCRIPT, LARAVEL FRAMEWORK AND MORE">
    <meta property="og:image" content="{{ asset('assets/images/_upload/websiteSettings/'.$websiteSettings['avatar']) }}">
    <meta property="facebook:card" content="summary">
    <meta property="facebook:url" content="{{ url() }}">
    <meta property="facebook:title" content="Atlanta Web Design">
    <meta property="facebook:description" content="Bruno Martins | Web Developer Front-End &amp; Back-End Developer in Atlanta / GA - PHP, HTML5, CSS3, JAVASCRIPT, LARAVEL FRAMEWORK AND MORE">
    <meta property="facebook:image" content="{{ asset('assets/images/_upload/websiteSettings/'.$websiteSettings['avatar']) }}">
    <meta property="facebook:site" content="{{ url() }}">
    <meta property="fb:card" content="summary">
    <meta property="fb:url" content="{{ url() }}">
    <meta property="fb:title" content="Atlanta Web Design">
    <meta property="fb:description" content="Bruno Martins | Web Developer Front-End &amp; Back-End Developer in Atlanta / GA - PHP, HTML5, CSS3, JAVASCRIPT, LARAVEL FRAMEWORK AND MORE">
    <meta property="fb:image" content="{{ asset('assets/images/_upload/websiteSettings/'.$websiteSettings['avatar']) }}">
    <meta property="fb:site" content="{{ url() }}">
    <base href="{{ url() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0; user-scalable=0;">
    <meta name="format-detection" content="telephone=no" />
    <meta name="publisher" content="Atlanta Web Design">
    <link rel="shortcut icon" href="{{ asset('assets/images/_upload/websiteSettings/'.$websiteSettings['favicon']) }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/_upload/websiteSettings/'.$websiteSettings['appleTouchIcon']) }}">
</head>
<body>
<!-- MODAL -->
<section id="AboutMeModal" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-lg">
        <article class="modal-content"></article>
    </div>
</section>
<section id="ContactModal" class="modal fade bs-example-modal-md">
    <div class="modal-dialog modal-md">
        <article class="modal-content"></article>
    </div>
</section>
<div class="right-bar"></div>
<div class="left-content">
    <div class="row-fluid main">
        <header class="header">
            <section class="col-lg-6 col-md-4 col-sm-5 col-xs-10 remove-padding-l"><h1 class="logo">{{ $websiteSettings['title'] }}</h1></section>
            <section class="col-lg-3 col-md-4 col-sm-3 col-xs-2">
                <ul class="social-network">
                    @if(!empty($websiteSettings['github']))
                    <li class="hidden-md hidden-xs">
                        <a href="{{ $websiteSettings['github'] }}" target="_blank" class="github" title="GitHub" data-placement="top"></a>
                    </li>
                    @endif
                    @if(!empty($websiteSettings['linkedin']))
                    <li class="hidden-md hidden-xs">
                        <a href="{{ $websiteSettings['linkedin'] }}" target="_blank" class="linkedin" title="LinkedIn" data-placement="top"></a>
                    </li>
                    @endif
                    <li>
                        <a href="{!! route('about-me') !!}" data-remote="{!! route('about-me-modal') !!}" class="aboutme clickmodal" title="About Me" data-placement="top" data-toggle="modal" data-target="#AboutMeModal"></a>
                    </li>
                    <li>
                        <a href="{!! route('contact') !!}" data-remote="{!! route('contact-modal') !!}" class="contact clickmodal" title="Contact" data-placement="top" data-toggle="modal" data-target="#ContactModal"></a>
                    </li>
                </ul>
            </section>
            <section class="col-lg-3 col-md-4 col-sm-4 hidden-xs">
                @if(!empty($websiteSettings['city']) and !empty($websiteSettings['state']))
                <h2 class="city-name">{{ $websiteSettings['city'].", ".$websiteSettings['state'] }}</h2>
                @endif
            </section>
        </header>
        <div class="clearfix"><br><br></div>
        <section class="content">
            <h3 class="font-size-24 gray text-uppercase">Latest Projects</h3>
            @foreach($projects as $project)
            <article class="{{ $project->bootstrapColumn }} latest-projects" data-sort="{{ $project->sortorder }}">
                <time datetime="{{ $project->projectDate->format('c') }}">{{ $project->projectDate->format('M dS, Y') }}</time>
                <a href="{{ route('projectIndex', [$project->projectDate->format('m'), $project->projectDate->format('Y'), $project->slug]) }}" data-href="{{ route('project', [$project->projectsId, $project->slug]) }}"
                   title="{{ $project->title }}">
                    <span class="animate-arrows"></span>
                    <img src="{{ url('assets/images/_upload/projects/'.$project->projectsId.'/'.$project->imagePrefixName.$project->image) }}" alt="{{ $project->title }}" />
                    <span class="title-project">
                        <strong>{{ $project->title }}</strong>
                        <em>{{ $project->type->projectsTypeName }}</em>
                    </span>
                </a>
            </article>
            @endforeach
        </section><!-- END .content -->
    </div><!-- END .row-fluid .main -->
    <!--<div id="loader"></div>-->
    <footer class="footer">
        <section class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            @if(!empty($websiteSettings['phone']))
            Phone: {{ $websiteSettings['phone'] }}
            <br />
            @endif
            Email: {{ $websiteSettings['email'] }}
        </section>
        <section class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
            &copy; {{ date('Y') }} Bruno Martins - Web Developer
        </section>
    </footer>
</div>
<link href="{!! url('assets/css/main.css') !!}" rel="stylesheet" type="text/css" />
<script src="{!! url('assets/js/main.js') !!}"></script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-70924364-2', 'auto');
ga('send', 'pageview');
</script>
@if(!empty($buttonClick))
<script>
$('a[href="<?=$buttonClick;?>"]').trigger('click');
</script>
@endif
@if(Session::has('message'))
<script>
    alert('{!! Session::get('message') !!}');
</script>
@endif
</body>
</html>