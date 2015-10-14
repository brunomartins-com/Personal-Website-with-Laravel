<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0; user-scalable=0;">
    <meta name="format-detection" content="telephone=no" />
    <meta name="author" content="Bruno Martins">
    <title>{{ $websiteSettings['title'] }}</title>
    <link href="{!! url('assets/ico/favicon.png') !!}" rel="shortcut icon" />
    <link href="{!! url('assets/css/main.css') !!}" rel="stylesheet" type="text/css" />
    <script src="{!! url('assets/js/jquery.js') !!}"></script>
</head>
<body>
<div class="right-bar"></div>
<div class="row-fluid main">
    <header class="header">
        <h1 class="col-lg-6 col-md-4 col-sm-5 col-xs-10 logo">{{ $websiteSettings['title'] }}</h1>
        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-2">
            <ul class="social-network">
                @if(!empty($websiteSettings['instagram']))
                <li>
                    <a href="{{ $websiteSettings['instagram'] }}" target="_blank" class="instagram" title="Instagram" data-placement="top"></a>
                </li>
                @endif
                @if(!empty($websiteSettings['linkedin']))
                <li>
                    <a href="{{ $websiteSettings['linkedin'] }}" target="_blank" class="linkedin" title="LinkedIn" data-placement="top"></a>
                </li>
                @endif
                <li>
                    <a href="{!! route('about-me') !!}" class="aboutme clickmodal" title="About Me" data-placement="top" data-toggle="modal" data-target="#modal"></a>
                </li>
                <li>
                    <a href="{!! route('contact') !!}" class="contact" title="Contact" data-placement="top" data-toggle="modal" data-target="#modal"></a>
                </li>
            </ul>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 hidden-xs">
            @if(!empty($websiteSettings['city']) and !empty($websiteSettings['state']))
            <h2 class="city-name">{{ $websiteSettings['city'].", ".$websiteSettings['state'] }}</h2>
            @endif
        </div>
    </header>
    <div class="clearfix"><br><br></div>
    <div class="content">
        <h3 class="font-size-24 gray text-uppercase">Latest Projects</h3>
        <div class="col-lg-3 col-md-3 col-sm-7 col-xs-7 latest-projects">
            <a href="job1.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job1.jpg" alt="Adidas" />
                <span class="title-project">
                    <strong>Adidas</strong>
                    <em>Web Design</em>
                </span>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-5 col-xs-5 latest-projects">
            <a href="job2.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job2.jpg" alt="Speedo" />
                <span class="title-project">
                    <strong>Speedo</strong>
                    <em>Graphic Design</em>
                </span>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-5 col-xs-5 latest-projects">
            <a href="job3.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job3.jpg" alt="The 80's" />
                <span class="title-project">
                    <strong>The 80's</strong>
                    <em>Graphic Design</em>
                </span>
            </a>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-7 col-xs-7 latest-projects">
            <a href="job4.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job4.jpg" alt="Montain Bike" />
                <span class="title-project">
                    <strong>Montain Bike</strong>
                    <em>Website</em>
                </span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 latest-projects">
            <a href="job4.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job5.jpg" alt="Coca-Cola" />
                <span class="title-project">
                    <strong>Coca Cola</strong>
                    <em>Hotsite</em>
                </span>
            </a>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-3 col-xs-6 latest-projects">
            <a href="job4.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job6.jpg" alt="Roogle Red" />
                <span class="title-project">
                    <strong>Roogle Red</strong>
                    <em>Website</em>
                </span>
            </a>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-7 latest-projects">
            <a href="job4.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job7.jpg" alt="Burger King" />
                <span class="title-project">
                    <strong>Brazil Flag</strong>
                    <em>Illustrator</em>
                </span>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 latest-projects">
            <a href="job4.html">
                <span class="animate-arrows"></span>
                <img src="assets/images/_upload/job8.jpg" alt="Burger King" />
                <span class="title-project">
                    <strong>Burger King</strong>
                    <em>Animation Graphic</em>
                </span>
            </a>
        </div>
    </div><!-- END .content -->
</div><!-- END .row-fluid .main -->
<footer class="footer">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        @if(!empty($websiteSettings['phone']))
        Phone: {{ $websiteSettings['phone'] }}
        <br />
        @endif
        Email: {{ $websiteSettings['email'] }}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
        &copy; {{ date('Y') }} {{ $websiteSettings['title'] }}
    </div>
</footer>
<!-- START MODAL -->
<div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>
<script src="{!! url('assets/js/main.js') !!}"></script>
<script>
if(!('ontouchstart' in window)) {
    $('.social-network a').tooltip();
}
$(".latest-projects a").pageslide({ direction: "left" });
</script>
</body>
</html>