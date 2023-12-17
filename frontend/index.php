<?php 
require "../connection.php";

$pageInfo=getTable("pageInfo");
if(count($pageInfo)>0)$pageInfo=$pageInfo[0];


?>





<!doctype html>
<html lang="en">


<head>
<meta charset="utf-8" />
<title><?=$pageInfo['name']?></title>

<meta name="description" content="Creative Agency, Marketing Agency Template">
<meta name="keywords" content="Creative Agency, Marketing Agency">
<meta name="author" content="SeparateWeb">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#111">

<link href="images/favicon.png" rel="icon">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/blueket.plugin.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;family=Open+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&amp;display=swap" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/colormode.css" rel="stylesheet">
</head>
<body>
<!--<div class="preloader">
<div class="preloader_inner">0%</div>
<div class="loaderlogo"><img src="images/logo-white.svg" alt="logo"></div>
</div>-->



<header class="header animation headerbg">
<div class="container-fluid">
<div class="wrapper">

<div class="header-item-left">
<a href="index.html" class="brandlogo">
<img src="images/logo-white.svg" alt="logo" class="light">
<img src="images/logo-black.svg" alt="logo" class="dark">
</a>
</div>

<div class="header-item-center hic">
<div class="overlay"></div>
<nav class="menu animation" id="menu">
<div class="menu-mobile-header">
<button type="button" class="menu-mobile-arrow"><i class="fa-solid fa-angle-left"></i></button>
<div class="menu-mobile-title"></div>
<button type="button" class="menu-mobile-close"><i class="fa-solid fa-xmark"></i></button>
</div>
<ul class="menu-section">

<?php
$navigations = getTable("navigations");
$subNavigations = getTable("subNavigations");

foreach ($navigations as $navigation) {
    $options = "";
    $subNavigationsList = array_filter($subNavigations, function ($value) use ($navigation) {
        return $value["hashTag"] == $navigation["hashTag"];
    });

    foreach ($subNavigationsList as $value) {
        $options .= "<li><a href={$value['url']}>{$value['name']}</a></li>";
    }

    echo "
    <li class='menu-item-has-children'>
        <a href='#'>{$navigation['name']}<i class='fa-solid fa-angle-down'></i></a>
        <div class='menu-subs menu-column-1'>
            <ul>
                {$options}
            </ul>
        </div>
    </li>";
}


?>


<li class="darkmodeswitch">
<div class="switch-wrapper d-none"> <label class="switch" for="blueket"> <input type="checkbox" id="blueket" /> <span class="slider round"></span> </label> </div>
</li>
</ul>
</nav>
</div>

<div class="header-item-right headeraction">
<ul>
<li><a href="tel:08072999853" class="menu-icon"><i class="fa-solid fa-phone"></i></a> </li>
<li><a href="https://wa.me/2348072999853" class="sw-btn sw-orange-btn header-btn">Sign Up </a></li>
<li><button type="button" class="menu-mobile-toggle"> <span></span> <span></span> <span></span> <span></span> </button> </li>
</ul>
</div>
</div>
</div>
</header>

<?php 
$editHeadingTexts=getTable("editHeadingTexts");
if(count($editHeadingTexts) > 0)$editHeadingTexts=$editHeadingTexts[0];
?>
<section class="demo-7-hero text-white">
<div class="herodiv" >

<video autoplay muted loop id="myVideo" poster="images/object/worlds.jpg">
<source src="images/object/worlds.mp4" type="video/mp4">
</video>
</div>
<div class="container-fluid index-up">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="hero-content">
<h1 class="mb20 wow fadeInUp" data-wow-delay=".8s"> <?php echo $editHeadingTexts['h1'] ?></h1>
<p class="wow fadeInUp" data-wow-delay="1.2s"><?php echo $editHeadingTexts['subH1'] ?></p>
<a href="https://wa.me/2348072999853" class="sw-btn sw-blue-btn wow fadeInUp mt40" onclick="window.location.href='<?php echo $editHeadingTexts['getStartedLink'] ?>'" data-wow-delay="1.4s">Get Started <i class="fa-solid fa-arrow-trend-up"></i></a>
<div class="hero-iconsets wow fadeInUp" data-wow-delay="1.6s">
<a href="#"><img src="images/icons/goodfirm-1.svg" alt="img"></a>
<a href="#"><img src="images/icons/clutch-1.svg" alt="img"></a>
<a href="#"><img src="images/icons/google-1.svg" alt="img"></a>
</div>
</div>
</div>
<div class="col-lg-7 mmt40">
<div class="hero-rght-sw wow fadeInUp" data-wow-delay="1.8s">
<div class="video-button" onclick="
 window.location.href='<?php $editHeadingTexts['playButtonLink']?>'   
"> <a href="#" class="video-play"> <span class="play-btn"> <i class="fa fa-play"></i> </span> </a> </div>
<h3><?php echo$editHeadingTexts['headingMessageText'] ?></h3>
</div>
<div class="cardsevc service--cards owl-carousel wow fadeInUp" data-wow-delay="2.5s">

<?php
$headingSlides=getTable("headingSlideContainers");
foreach($headingSlides as $headingSlidesItem){
echo "

<div class='service-card-div service-slide'>
<a href='{$headingSlidesItem['clickRedir']}'>
<div class='service-images'><img src='{$headingSlidesItem['iconImage']}' alt='#'></div>
<div class='service-name'>{$headingSlidesItem['name']}</div>
<div class='circleffect'>
<div class='animation'>&nbsp;</div>
</div>
</a>
</div>
";
}
?>
<!--
<div class="service-card-div service-slide">
<a href="https://wa.me/2348072999853">
<div class="service-images"><img src="images/object/Other-20.png" alt="#"></div>
<div class="service-name">Graphic <br> Design </div>
<div class="circleffect">
<div class="animation">&nbsp;</div>
</div>
</a>
</div>
<div class="service-card-div service-slide">
<a href="https://wa.me/2348072999853">
<div class="service-images"><img src="images/object/Other-11.png" alt="#"></div>
<div class="service-name">Blockchain <br> Development </div>
<div class="circleffect">
<div class="animation">&nbsp;</div>
</div>
</a>
</div>
<div class="service-card-div service-slide">
<a href="https://wa.me/2348072999853">
<div class="service-images"><img src="images/object/Other-16.png" alt="#"></div>
<div class="service-name">Ecommerce <br> Development </div>
<div class="circleffect">
<div class="animation">&nbsp;</div>
</div>

</a>
</div>
<div class="service-card-div service-slide">
<a href="https://wa.me/2348072999853">
<div class="service-images"><img src="images/object/Other-13.png" alt="#"></div>
<div class="service-name">Digital <br> Marketing </div>
<div class="circleffect">
<div class="animation">&nbsp;</div>
</div>
</a>
</div>
--->

</div>
</div>
</div>
</div>
</section>


<section class="aboutblock section-space">
<div class="container">
<div class="row justify-content-between">
<div class="col-lg-6">
<div class="about-conent paragraph">
    <?php
$whoWeAreComponent=getTable("whoWeAreComponent");
if($whoWeAreComponent)$whoWeAreComponent=$whoWeAreComponent[0]
    ?>
<span class="scriptheading dashbefore mb15 wow fadeIn" data-wow-delay=".2s" data-wow-duration="1500ms">WHO WE ARE</span>
<h2 class="mb20 wow fadeIn" data-wow-delay=".4s" data-wow-duration="1500ms"><?php echo $whoWeAreComponent['heading']?></h2>
<p class="wow fadeIn" data-wow-delay=".6s" data-wow-duration="1500ms"><?php echo $whoWeAreComponent['text']?></p>
<a href="<?php echo $whoWeAreComponent['clickRedir']?>" class="sw-btn sw-blue-btn mt30"><?php echo $whoWeAreComponent['buttonText'] ?></a>
</div>
</div>

<?php
$OurInfo=getTable("OurInfo");
if($OurInfo)$OurInfo=$OurInfo[0]
    ?>
<div class="col-lg-5 mmt40">
<div class="row blockcntr swpt1">
<div class="counter-numbers  demo2counter col-lg-6 col-md-12">
<div class="counter-setdiv shadow wow fadeIn" data-wow-delay=".1s">
<img src="images/icons/rocket.gif" alt="img">
<p> <span data-count-to="<?php  echo $OurInfo['YearsOfExperience']?>" class="odometer"></span>+</p>
<span class="countertag">Years Experience</span>
</div>
<div class="counter-setdiv shadow wow fadeIn" data-wow-delay=".7s">
<img src="images/icons/laptop.gif" alt="img">
<p><span data-count-to="<?php  echo $OurInfo['projectsDelivered']?>" class="odometer"></span>+</p>
<span class="countertag">Projects Delivered</span>
</div>
</div>
<div class="counter-numbers  demo2counter col-lg-6 col-md-12 seccnt">
<div class="counter-setdiv shadow wow fadeIn" data-wow-delay=".4s">
<img src="images/icons/user.gif" alt="img">
<p><span data-count-to="<?php  echo $OurInfo['talentedTeam']?>" class="odometer"></span>+</p>
<span class="countertag">Talented Team</span>
</div>
<div class="counter-setdiv shadow wow fadeIn" data-wow-delay="1s">
<img src="images/icons/earth.gif" alt="img">
<p><span data-count-to="<?php  echo $OurInfo['countriesServed']?>" class="odometer"></span>+</p>
<span class="countertag">Countries Served</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section-space bkbg3">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-7 col-lg-8 text-center">
<h2 class="text-gradient-1 mb15 wow fadeIn" data-wow-delay=".2s">Services We Provide</h2>
<p class="wow fadeIn" data-wow-delay=".4s">Coder-Test overcomes challenges, achieves results, and adds value to our clients and partners. Take a look at some of our clients' success stories.</p>
</div>
</div>
<div class="row mt30 dm4">
<div class="col-lg-3 col-sm-6 mt30 wow fadeIn" data-wow-delay=".1s">
<div class="sw-card white-bg shadow">
<img src="images/icons/app.png" alt="icon" class="innercardiocn">
<h3 class="swbttitlex">App<br> Development</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
<div class="col-lg-3 col-sm-6 mt30 wow fadeIn" data-wow-delay=".4s">
<div class="sw-card white-bg shadow">
<img src="images/icons/ux-design.png" alt="icon" class="innercardiocn">
<h3 class="swbttitlex">Web<br> Development</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
<div class="col-lg-3 col-sm-6 mt30 wow fadeIn" data-wow-delay=".8s">
<div class="sw-card white-bg shadow">
<img src="images/icons/content.png" alt="icon" class="innercardiocn">
<h3 class="swbttitlex">Content<br> Marketing</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
<div class="col-lg-3 col-sm-6 mt30 wow fadeIn" data-wow-delay="1.2s">
<div class="sw-card white-bg shadow">
<img src="images/icons/online-shop.png" alt="icon" class="innercardiocn">
<h3 class="swbttitlex">eCommerce<br> Development</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
</div>
<div class="row index-up wow fadeIn" data-wow-delay=".8s">
<div class="col-lg-12">
<div class="tech-slider mt100">
<div class="sw-icon-slider owl-carousel">

<?php 
$Technologies=getTable("Technologies");
foreach($Technologies as $Technology){
echo "<div class='icon-slider-block'>
<div class='slider-icon'> <img src='{$Technology['icon']}' alt='Android'> </div>
<div class='slider-icon-text'>
<p>{$Technology['name']}</p>
</div>
</div>
";
}
?>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="word-block-div section-space">
<div class="container">
<div class="row">
<div class="col-lg-6">
   <h2 class="text-gradient-1 wow fadeInUp" data-wow-delay=".4s"><?php 

    $latestProjects=getTable("LatestProjects");
    if(count($latestProjects) > 0)$latestProjects=$latestProjects[0];
    else{
        echo "cannot find latest project";
    }
   $latestProjectsList=getTable("LatestProjectsList");
  echo $latestProjects['heading'] ?></h2>
<a href="portfolio.html" class="inline-btn mt20 wow fadeInUp" data-wow-delay=".8s">View all Projects <i class="fa-solid fa-arrow-trend-up"></i></a>
</div>
<div class="col-lg-6 mmt30">
<p class=" wow fadeInUp" data-wow-delay="1.2s"><?php echo $latestProjects['subHeading'] ?></p>
</div>
</div>
</div>
<div class="container-fluid mt60">
<div class="row  wow fadeInUp" data-wow-delay="1.4s">
<div class="col-lg-12">
<div class="work-slide owl-carousel full-button centerbtns">

<?php 

foreach ($latestProjectsList as $key => $project) {
    # code...

echo "<div class='our-works'>
<div class'work-imags'><a href='#'><img src='{$project['image']}'alt='work' class='card-img-round'></a></div>
<div class='infoblocis'>
<div class='nameofitem'>
<h3>{$project['heading']}</h3>
<p class='mt5'>{$project['subHeading']}</p>
</div>
</div>
</div>";
}
?>

</div>
</div>
</div>
</div>
</section>


<section class="section-space">
<div class="container index-up">
<div class="row justify-content-between">
<div class="col-lg-4">
    <?php
$BusinessInfoImage=getTable("BusinessInfoImage");
if(count($BusinessInfoImage))$BusinessInfoImage=$BusinessInfoImage[0];
    ?>
<div class="roundimg"><img src="<?php echo $BusinessInfoImage['image']; ?>" alt="img" class="w-100"></div>
</div>
<div class="col-lg-7 mmt40">
<h3 class="text-gradient-1 mb15 wow fadeIn" data-wow-delay=".2s"><?php echo $BusinessInfoImage["heading"]; ?></h3>
<p class="wow fadeIn" data-wow-delay=".6s"><?php echo $BusinessInfoImage['text']; ?></p>
<h5 class="mt30 wow fadeIn" data-wow-delay=".9s">Talk with the expert to grow your business</h5>
<ul class="bulletpoints mt30  wow fadeInUp" data-wow-delay="1s">
    <?php 
    $BusinessInfoList=getTable("BusinessInfoList");
    foreach($BusinessInfoList as $Business){
        echo "<li>{$Business['text']}</li>";
    }
    ?>
</ul>
</div>
</div>
</div>

<div class="cta-block-sw-bkt ctacnttr">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="cta-design-block-sw gradient-1 v-center">
<div class="cta-info-div-bkt">
<h3 class="mb15">Let's Create an Amazing Project Together!</h3>
<p>Web design app development for Android & iOS. We have over 5 years of experience in helping companies.</p>
<a href="#" class="sw-btn sw-white-btn mt30">Get Started <i class="fa-solid fa-arrow-trend-up"></i></a>
</div>
<div class="cta-img-div-bkt"><img src="images/common/app-mockup-2.svg" alt="img"></div>
</div>
</div>
</div>
</div>
</div>

<div class="container index-up">
<div class="row justify-content-between">
<div class="col-lg-6">
<h3 class="text-gradient-1 mb15 wow fadeIn" data-wow-delay=".2s">Get An Exclusively Brewed Digital Solution For Your Business</h3>
<p class="wow fadeIn" data-wow-delay=".6s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt finibus tortor. Donec lobortis augue sed ante molestie, vitae maximus nunc semper.</p>
<a href="#" class="sw-btn sw-blue-btn mt30 wow fadeInUp" data-wow-delay="1s">Get Started <i class="fa-solid fa-arrow-trend-up"></i></a>
<div class="medianumbers mt40">
<div class="mediablock wow fadeInUp" data-wow-delay=".8s">
<div class="ex---">
<div class="progressbar circle-bar orange" data-value="65"></div>
</div>
<div class="stats-break"></div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec gravida purus.</p>
</div>
<div class="mediablock mt30 wow fadeInUp" data-wow-delay="1s">
<div class="ex---">
<div class="progressbar circle-bar blue" data-value="40"></div>
</div>
<div class="stats-break"></div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec gravida purus.</p>
</div>
</div>
</div>
<div class="col-lg-4 position-relative mmt40">
<div class="roundimg wow fadeIn" data-wow-delay="1.2s"><img src="images/common/company.jpg" alt="img" class="w-100"></div>
<div class="img-overthe-card wow fadeIn" data-wow-delay="1.6s">
<h4>Excellent Team</h4>
<p>Creativ Idea</p>
<div class="card-v-light"></div>
<div class="mediablock mt30">
<div class="user-image wh"><img src="images/common/user-image-3.jpg" alt="review"></div>
<div class="user-content">
<h5>Riya Smily</h5>
<p>Marketing Manager</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="industry-work section-space bg-efffect-1 bkbg3 pb300">
<div class="container index-up">
<div class="row">
<div class="col-lg-10">
<span class="scriptheading dashbefore mb15">We Work In</span>
<h2 class="text-gradient-1">Our Industry Wise Solution</h2>
</div>
</div>
<div class="row justify-content-between">
<div class="col-lg-12">
<div class="cate-with-img-main">
<div class="roundiconwithdata wow fadeIn" data-wow-delay=".1s">
<div class="imgimg"><img src="images/icons/house.svg" alt="img"> </div>
<p>Real Estate</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay=".4s">
<div class="imgimg"><img src="images/icons/travel-luggage.svg" alt="img"> </div>
<p>Tour & Travels</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay=".7s">
<div class="imgimg"><img src="images/icons/magistrate.svg" alt="img"> </div>
<p>Education</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="1s">
<div class="imgimg"><img src="images/icons/car.svg" alt="img"> </div>
<p>Transport</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="1.3s">
<div class="imgimg"><img src="images/icons/calendar.svg" alt="img"> </div>
<p>Event</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="1.6s">
<div class="imgimg"><img src="images/icons/online-shop.svg" alt="img"> </div>
<p>eCommerce</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="1.9s">
<div class="imgimg"><img src="images/icons/game-controller.svg" alt="img"> </div>
<p>Game</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="2.2s">
<div class="imgimg"><img src="images/icons/healthcare.svg" alt="img"> </div>
<p>Healthcare</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="2.5s">
<div class="imgimg"><img src="images/icons/piggy-bank.svg" alt="img"> </div>
<p>Finance</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="2.8s">
<div class="imgimg"><img src="images/icons/restaurant.svg" alt="img"> </div>
<p>Restaurant</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="3.1s">
<div class="imgimg"><img src="images/icons/layers.svg" alt="img"> </div>
<p>On-Demand</p>
</div>
<div class="roundiconwithdata wow fadeIn" data-wow-delay="3.4s">
<div class="imgimg"><img src="images/icons/grocery-bag.svg" alt="img"> </div>
<p>Grocery</p>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="office-interior imageoutofbox pb100">
<div class="container">
<div class="row">
<div class="col-lg-9">
<div class="imageoutbox">
<img src="images/common/office-building.jpg" alt="office" class="card-img-round  wow fadeIn" data-wow-delay=".2s">
</div>
</div>
</div>
<div class="row mt60 mmt40">
<div class="col-lg-6">
<div class="title-heading wow fadeIn" data-wow-delay=".4s">
<h2>Trusted Web Design Company Since 2008</h2>
</div>
</div>
<div class="col-lg-6 mmt30">
<div class="title-paragraph wow fadeIn" data-wow-delay=".6s">
<p>We are a Web development company. we provide web design, app development, digital marketing services.
As you can imagine, the market is evolving with every new platform and feature added to an website. The number of developers jumping into this field has grown over time which means more users need responsive websites in order for them not only stand out from other ones but also have fast response times when visitors click on your site.
</p>
</div>
</div>
</div>
</div>
</section>


<section class="clients-section section-space bg--1">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-10 text-center">
<span class="scriptheading mb15 wow fadeIn" data-wow-delay=".2s">Review/Feedback</span>
<h2 class="text-gradient-1 wow fadeIn" data-wow-delay=".4s">Happy Clients With Digital Transformation</h2>
</div>
</div>
<div class="row mt60">
<div class="col-lg-12">
<div class="review-slider owl-carousel full-button">
<div class="blueket-card-noise card-img-round pt30">
<div class="review-img-block">
<div class="user-image"><img src="images/common/user-image.jpg" alt="review"></div>
<div class="user-content">
<h5>Karan Kumar</h5>
<p>CTO @ Amber Fund</p>
</div>
</div>
<div class="review-content mt30 mb30">
<p>When it comes to website development and SEO, Blueket has been the best company I've worked with so far. We hired them for both of our businesses and have seen a drastic increase in our customer base.</p>
</div>
<div class="review-footer pair-block">
<div class="image-icon">
<a href="#"><img src="images/icons/google.png" alt="icon"></a>
</div>
<div class="starrating">
<ul>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
</ul>
</div>
</div>
</div>
<div class="blueket-card-noise card-img-round pt30">
<div class="review-img-block">
<div class="user-image"><img src="images/common/user-image-2.jpg" alt="review"></div>
<div class="user-content">
<h5>Mike Smith</h5>
<p>Business Man</p>
</div>
</div>
<div class="review-content mt30 mb30">
<p>When it comes to website development and SEO, Blueket has been the best company I've worked with so far. We hired them for both of our businesses and have seen a drastic increase in our customer base.</p>
</div>
<div class="review-footer pair-block">
<div class="image-icon">
<a href="#"><img src="images/icons/google.png" alt="icon"></a>
</div>
<div class="starrating">
<ul>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
</ul>
</div>
</div>
</div>
<div class="blueket-card-noise card-img-round pt30">
<div class="review-img-block">
<div class="user-image"><img src="images/common/user-image-3.jpg" alt="review"></div>
<div class="user-content">
<h5>Riya Smily</h5>
<p>CEO @ Tema Security</p>
</div>
</div>
<div class="review-content mt30 mb30">
<p>When it comes to website development and SEO, Blueket has been the best company I've worked with so far. We hired them for both of our businesses and have seen a drastic increase in our customer base.</p>
</div>
<div class="review-footer pair-block">
<div class="image-icon">
<a href="#"><img src="images/icons/google.png" alt="icon"></a>
</div>
<div class="starrating">
<ul>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
</ul>
</div>
</div>
</div>
<div class="blueket-card-noise card-img-round pt30">
<div class="review-img-block">
<div class="user-image"><img src="images/common/user-image-4.jpg" alt="review"></div>
<div class="user-content">
<h5>Oliver Kanjorva</h5>
<p>Business Man</p>
</div>
</div>
<div class="review-content mt30 mb30">
<p>When it comes to website development and SEO, Blueket has been the best company I've worked with so far. We hired them for both of our businesses and have seen a drastic increase in our customer base.</p>
</div>
<div class="review-footer pair-block">
<div class="image-icon">
<a href="#"><img src="images/icons/google.png" alt="icon"></a>
</div>
<div class="starrating">
<ul>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
<li> <a href="#" class="checked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row mt60 v-center">
<div class="col-lg-4">
<h4>Read More Review on</h4>
<p class="mt15">Read our client's testimonials all around the web. We deliver quality service that loves everyone.</p>
</div>
<div class="col-lg-8">
<div class="review-links mt30">
<a href="#" class="wow fadeIn" data-wow-delay=".2s"><img src="images/clients/trustplot.svg" alt="#"> </a>
<a href="#" class="wow fadeIn" data-wow-delay=".4s"><img src="images/clients/clutchreview.svg" alt="#"> </a>
<a href="#" class="wow fadeIn" data-wow-delay=".6s"><img src="images/clients/appstore.svg" alt="#"> </a>
</div>
</div>
</div>
</div>
</section>


<footer class="footer-design-sw pt80 pb30 text-white swdarkfooter">
<div class="container index-up">
<div class="row justify-content-between">
<div class="col-lg-4">
<div class="footer-brand-info">
<div class="footer-logo-sw">
<a href="#"><img src="images/logo-white.svg" alt="logo" class="light"></a>
<a href="#"><img src="images/logo-white.svg" alt="logo" class="dark"></a>
</div>

<div class="ft-address-blocks mt60">
<div class="subsc-div-sw">
<h5>Ready to Move Forward and Get the Latest Insights.</h5>
<div class="blueketsubscriptionbox mt30">
<form>
<div class="form-inputs subsform">
<input type="tel" class="form-controls" placeholder="Enter Your Email">
<a href="mailto:austinesamuel914@gmail.com"><button type="button" class="sw-orange-btn"><i class="fa-solid fa-paper-plane"></i></button></a>
</div>
</form>
</div>
</div>
</div>


<div class="social-link-sw mt40">
<span class="linktitle">Follow Us</span>
<ul class="footer-social-sw mt10 sw-hover-2">
<li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
<li> <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
<li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
<li><a href="#"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
<li> <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a> </li>
</ul>
</div>

</div>
</div>
<div class="col-lg-6">
<div class="row mt40 sw-hover-1">
<div class="col-lg-4 col-md-6 col-6 mt30">
<div class="footer-links">
<h5 class="linktitle">Company Links</h5>
<ul class="mt20">
<li><a href="#">About Us</a></li>
<li><a href="#">Contact Us</a></li>
<li><a href="#">Careers</a></li>
<li><a href="#">Our Team</a></li>
<li><a href="#">Media Coverage</a></li>
<li><a href="#">Referral Program</a></li>
<li><a href="#">Case Studies</a></li>
<li><a href="#">Client Testimonials</a></li>
</ul>
</div>
</div>
<div class="col-lg-4 col-md-6 col-6 mt30">
<div class="footer-links">
<h5 class="linktitle">Technologies</h5>
<ul class="mt20">
<li><a href="#">React JS</a></li>
<li><a href="#">Laravel</a></li>
<li><a href="#">CodeIgniter</a></li>
<li><a href="#">Node JS</a></li>
<li><a href="#">WordPress</a></li>
<li><a href="#">Magento</a></li>
<li><a href="#">ReactJS</a></li>
<li><a href="#">KnockoutJs</a></li>
</ul>
</div>
</div>
<div class="col-lg-4 col-md-6 col-6 mt30">
<div class="footer-links">
<h5 class="linktitle">Our Services</h5>
<ul class="mt20">
<li><a href="#">Web Application</a></li>
<li><a href="#">Mobile App Development</a></li>
<li><a href="#">Microsoft Development</a></li>
<li><a href="#">Front End Development</a></li>
<li><a href="#">eCommerce Development</a></li>
<li><a href="#">Cross-platform App</a></li>
<li><a href="#">Opensource Development</a></li>
<li><a href="#">UI/UX Design</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="footerbreak swhr">
<div class="award-badge-block mt50">
<a href="#"><img src="images/icons/award-badge-1.png" alt="icon"></a>
<a href="#"><img src="images/icons/award-badge-2.png" alt="icon"></a>
<a href="#"><img src="images/icons/award-badge-3.png" alt="icon"></a>
<a href="#"><img src="images/icons/award-badge-5.png" alt="icon"></a>
<a href="#"><img src="images/icons/award-badge-6.png" alt="icon"></a>
<a href="#"><img src="images/icons/award-badge-7.png" alt="icon"></a>
</div>
</div>

<div class="footercreditandrevielinks swhr pt20 mt60">
<div class="row">
<div class="col-lg-12">
<div class="footercreditnote sw-hover-1">
<div>
<p>© 2022 All Rights Reserved By <a href="#"> Separateweb</a></p>
</div>
<div class="linkftsw">
<ul class="list-h-styled">
<li><a href="#">Sitemap</a></li>
<li><a href="#">Terms of Use</a></li>
<li><a href="#">Privacy Policy</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</footer>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/my.plugin.js"></script>
<script src="js/theme.darkmode.js"></script>
<script src="js/noframework.waypoints.min.js"></script>
<script src="js/progressbar.min.js"></script>

<script src="js/custom.js"></script>
</body>

<!-- Mirrored from separateweb.com/tm-blueket/demo-digital-agency.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2023 20:41:34 GMT -->
</html>