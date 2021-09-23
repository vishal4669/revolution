@include('frontend.layouts.header')
      <style type="text/css">
        
        .social-login > div {
    margin-bottom: 25px;
}
.jb-btn-icon,
.jb-btn-icon:hover,
.jb-btn-icon:focus {
    display: inline-block;
    width: 100%;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    background: #f4f5f7;
    color: #fff;
    text-transform: uppercase;
    border: none;
    padding: 14px 25px;
    font-weight: 600;
    font-size: 13px;
    position: relative;
    z-index: 0;
}
.social-login i {
    padding-right: 25px;
    margin-right: 25px;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    top: 0;
    font-size: 18px;
    font-weight: 500;
}
.social-login .social-login-facebook {
    background: #3b5998;
}
.social-login .social-login-google {
    background: #db4437;
}
.social-login .social-login-twitter {
    background: #0084b4;
}
.social-login .social-login-linkedin {
    background: #006fa6;
}
      </style>
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Login</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="{{route('home')}}">Home</a>/</li>
                <li><span>Login</span></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <!-- Bread Crumb END --> 

      <!-- CONTAIN START -->
      <section class="checkout-section ptb-70">
        <div class="container">

          <div class="social-login row">                
                <div class="col-md-6">
                    <a href="{{ route('fb.redirect','facebook') }}" class="jb-btn-icon social-login-facebook"><i class="fa fa-facebook"></i>Facebook</a>
                </div>
                
                <div class="col-md-6">
                    <a href="{{ route('fb.redirect','google') }}" class="jb-btn-icon social-login-google"><i class="fa fa-google-plus"></i>Google</a>
                </div>
                
            </div>

          <div class="row">
            <div class="col-12">

              <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-8 ">
                  <form class="main-form full" method="POST" action="{{ route('signin.validate') }}">
                    <div class="row">
                      <div class="col-12 mb-20">
                        <div class="heading-part heading-bg">
                          <h2 class="heading">Login</h2>
                        </div>

                        @if (isset($error_msg) && $error_msg!='')
                          <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <span>{{$error_msg}}</span>
                          </div>
                        @endif

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                          <p>{{ $message }}</p>
                        </div>
                        @endif

                      </div>
                      @csrf
                      <div class="col-12">
                        <div class="input-box">
                          <label for="login-email">Email address</label>
                          <input id="login-email" name="email" type="email" required placeholder="Email Address">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="input-box">
                          <label for="login-pass">Password</label>
                          <input id="login-pass" name="password" type="password" required placeholder="Enter your Password">
                        </div>
                      </div>

                      <div class="col-12">
                        <!--<div class="check-box left-side"> 
                          <span>
                            <input type="checkbox" name="remember_me" id="remember_me" class="checkbox">
                            <label for="remember_me">Remember Me</label>
                          </span>
                        </div>-->
                        <button name="submit" type="submit" class="btn-color right-side">Log In</button>
                      </div>
                      <div class="col-12"> 
                        <!--<a title="Forgot Password" class="forgot-password mtb-20" href="javascript:void(0)">Forgot your password?</a>-->
                        <hr>
                      </div>
                      <div class="col-12">
                        <div class="new-account align-center mt-20"> <span>New to Revolution Bike Store?</span> <a class="link" title="Register with Revolution" href="{{ route('register') }}">Register New Account</a> </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- CONTAINER END --> 
      
  @include('frontend.layouts.footer')    