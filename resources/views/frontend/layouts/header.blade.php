<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
  <!--<![endif]-->
  

<head>
  <style type="text/css">
    .error{color: red;    font-weight: 300;}
    .alert{padding: 10px 0px 0px 4px}

  </style>
  <!-- Basic Page Needs
    ================================================== -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Revolution Bike Store - Cycle Store In Ahmedabad</title>
  <!-- SEO Meta
    ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="2 Days">
  <meta name="robots" content="ALL">
  <meta name="rating" content="8 YEARS">
  <meta name="Language" content="en-us"> 
  <meta name="GOOGLEBOT" content="NOARCHIVE">
  <!-- Mobile Specific Metas
    ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- CSS
    ================================================== -->
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/font-awesome.min.css') }}"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/bootstrap.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/jquery-ui.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/owl.carousel.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/fotorama.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/magnific-popup.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/responsive.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/plan.css') }}">
  <link rel="shortcut icon" href="{{url('frontend/images/f-icon.png')}}">
  <link rel="apple-touch-icon" href="{{ url('frontend/images/apple-touch-icon.html') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ url('frontend/images/apple-touch-icon-72x72.html') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ url('frontend/images/apple-touch-icon-114x114.html') }}">
  <!--CSS-->
  <link rel="stylesheet" href="{{ url('frontend/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ url('frontend/css/jquery.timepicker.min.css') }}">

  </head>
  <body class="homepage">
    <!--<div class="se-pre-con"></div>
    <div id="newslater-popup" class="mfp-hide white-popup-block open align-center">
      <div class="nl-popup-main">
        <div class="nl-popup-inner">
          <div class="newsletter-inner">
            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-8">
                <h2 class="main_title">join now</h2>
                <span>before it's too late</span>
                <p>Sing up now to receive this exclusive offer for a limited time only!</p>
                <form>
                  <input type="email" placeholder="Email Here...">
                  <button class="btn-black" title="Subscribe">Subscribe</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <div class="main">

      <!-- PRODUCT-POPUP START -->
      
      <!-- PRODUCT-POPUP END -->
      
     
      <!-- HEADER START -->
     <header class="navbar navbar-custom container-full-sm" id="header">
        <div class="header-top">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 col-5">
                <div class="top-left">
                  <ul>
                    <li>
                      <div class="info">
                        Upcoming Event:
                        <span class="coupon"> <i class="fa fa-event"></i>{{ $latestEvent->name }} : Date - {{ date('d-m-Y', strtotime($latestEvent->event_start_day)) }}</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-6 col-7">
                <div class="top-right-link right-side">
                  <ul>
                    @auth
                      <li class="info-link login-icon content">
                        <a href="{{ route('frontend.myaccount') }}" title="My Account"><span></span>My Account</a>
                      </li>
                      <li class="info-link checkout-icon">

                        <a  href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-in"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                       <?php /*<a href="{{ route('signout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form-user').submit();">
                                <i class="fa fa-sign-in"></i> Logout</a>
                        <form id="logout-form-user" action="{{ route('signout') }}" method="POST" style="display: none;">
                        @csrf
                        </form> */?>
                      
                    </li>
                    @else
                      <li class="info-link login-icon content">
                        <a href="{{ route('login') }}" title="Login"><span></span> Login</a>
                      </li>
                      @if (Route::has('register'))
                        <li class="info-link register-icon">
                           <a href="{{ route('register') }}" title="Register"><span></span> Register</a>
                        </li>
                      @endif
                    @endauth
                    <li class="info-link contact-icon">
                      <a href="{{ route('contact') }}" title="Contact Us"><span></span> Contact Us</a>
                    </li>
                   
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-middle d-xl-none">
          <div class="container">
            <div class="row m-0">
              <div class="col-6 p-0">
                <div class="header-middle-left">
                  <div class="navbar-header float-none-sm">
                    <a class="navbar-brand page-scroll" href="index.php">
                      <img alt="Revolution Bike Store" src="{{url('frontend/images/Logorevolutionbikecafe.png')}}" style="width: 100px;">
                    </a> 
                  </div>
                </div>
              </div>
              <div class="col-6 p-0">
                <div class="right-side header-right-link">
                  <ul>
                    <li class="search-box">
                      <a><span></span></a>
                    </li>
    
                    <li class="side-toggle">
                      <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><i class="fa-bar"></i></button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-bottom">
          <div class="container">
          <div class="row">
              <div class="col-lg-2">
                    <a class="navbar-brand page-scroll" href="{{route('home')}}">
                      <img class="pc_logo" alt="Revolution Bike Store" src="{{url('frontend/images/Logorevolutionbikecafe.png')}}" style="width: 100px;">
                    </a> 
              </div> 
              <div class="col-lg-10">
              <div id="menu" class="navbar-collapse collapse" >
                  <ul class="nav navbar-nav">
                    <li class="level"><a href="{{route('home')}}" class="page-scroll">Home </a></li>
                    <!--<li class="level"><a href="#" class="page-scroll">Get Started </a></li>-->
                    <li class="level"><a href="{{route('package')}}" class="page-scroll" title="Indoor Training Packages">Indoor Packages </a></li>
                    <li class="level"><a href="{{route('rent-cycles')}}" class="page-scroll" title="Click to see all cycles">Rent Cycles </a></li>
                    <li class="level"><a href="{{route('rent-trainers')}}" class="page-scroll">Rent Trainers </a></li>
                    <li class="level"><a href="{{route('training')}}" class="page-scroll">Booking </a></li>
                    <li class="level"><a href="{{ route('allevents') }}" class="page-scroll">Events </a></li>
                    <!--<li class="level"><a href="{{route('offroad')}}" class="page-scroll">off road </a></li>
                    <li class="level"><a href="{{route('shop')}}" class="page-scroll">Shop </a></li>-->
                    
                  </ul>
                  <!--<div class="search-btn-icon search-opener right-side">
                    <button class="search-btn"></button>
                  </div>-->
                  <div class="header-top mobile">
                    <div class="">
                      <div class="row">
                        <div class="col-12">
                          <div class="language-currency select-dropdown">
                            <fieldset>
                              <select name="speed" class="country option-drop">
                                <option selected="selected">English</option>
                              </select>
                              <select name="speed" class="currency option-drop">
                                <option selected="selected">INR</option>
                              </select>
                            </fieldset>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
          </div>
          </div>
        </div>
      </header>

      <div class="sidebar-search-wrap">
        <div class="sidebar-table-container">
          <div class="sidebar-align-container">
            <div class="search-closer right-side"></div>
            <div class="search-container">
              <form method="get" id="search-form">
                <input type="text" id="s" class="search-input" name="s" placeholder="Start Searching">
              </form>
              <span>Search and Press Enter</span>
            </div>
          </div>
        </div>
      </div>
      <!-- HEADER END -->  