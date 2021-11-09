<?php
date_default_timezone_set('America/Los_Angeles');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Freichat Backend">
    <title>Welcome to Freichat</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="icon" type="image/png" href="assets/img/freichatLogoOnly.png?v=1" />
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand navbar-link" href="#" style="color:rgb(16,16,16);padding:10px;"> <img src="assets/img/head.png" height="30"></a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active" role="presentation"><a href="https://freichat.com/documentation/introduction" target="_blank">Documentation </a></li>
                <li role="presentation"><a href="https://freichat.com" target="_blank" style="color:rgb(51,51,51);">Freichat-Website </a></li>
                <li role="presentation">
                    <a href="#"> </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="jumbotron hero">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-push-7 phone-preview">
                <div class="iphone-mockup"><img src="assets/img/iphone.svg" class="device">
                    <div class="screen" style="background-image:url(&quot;assets/img/city_bg.jpg&quot;);"></div>
                </div>
            </div>
            <div class="col-md-6 col-md-pull-3 get-it">
                <h1>The Fantastic chatting system</h1>
                <p>Over 50k+ websites have been using Freichat since it was launched in 2010.
                    With over 7 years of experience in building chatting systems,
                    we bring you the new Freichat v.11 -- Raise your user engagement to the next level.</p>
                <p><a class="btn btn-primary btn-lg" role="button" href="administrator/index.php"><i class="fa fa-gears"></i> ADMINISTER</a><a class="btn btn-success btn-lg" role="button" href="installation/index.php"><i class="fa fa-download"></i> INSTALL</a></p>
            </div>
        </div>
    </div>
</div>
<section class="testimonials">
    <h2 class="text-center">People Love It!</h2>
    <blockquote>
        <p>Installed in over 50K+ websites and 3 government organizations.</p>
    </blockquote>
</section>
<section class="features">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Fantastic Support</h2>
                <p> Stuck? Have a unique problem? we provide gauranteed help with direct support from our talented developers . Come, say hi to us on support@codologic.com</p>
            </div>
            <div class="col-md-6">
                <div class="row icon-features">
                    <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-cloud"></i>
                        <p>Scalable </p>
                    </div>
                    <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-piggy-bank"></i>
                        <p>Low Bandwidth</p>
                    </div>
                    <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-fire"></i>
                        <p>Hot on Features</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h5 style="font-size:12px;">Freichat © <?php echo date('Y'); ?> - Part of Codologic pvt. ltd.</h5></div>
            <div class="col-sm-6 social-icons"><a href="https://www.facebook.com/codologic/" target="_blank"><i class="fa fa-facebook"></i></a><a href="https://plus.google.com/+codologic" target="_blank"><i class="fa fa-google"></i></a>
                <a href="https://twitter.com/codologic" target="_blank"><i class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>