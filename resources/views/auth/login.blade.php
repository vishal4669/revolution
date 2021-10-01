@include('frontend.layouts.header')
      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Login</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
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
          <div class="row">
            <div class="col-12">
              <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-8 ">
                  <form class="main-form full" method="POST" action="{{ route('login') }}">
                    <div class="row">
                      <div class="col-12 mb-20">
                        <div class="heading-part heading-bg">
                          <h2 class="heading">Login</h2>
                        </div>

                        @if(session()->has('message'))
                            <p class="alert alert-info">
                                {{ session()->get('message') }}
                            </p>
                        @endif

                      </div>
                      @csrf
                      <div class="col-12">
                        <div class="input-box">
                          <label for="login-email">Email address</label>
                          <input id="login-email" name="email" type="email" value="{{ old('email'), null }}" required placeholder="Email Address">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="input-box">
                          <label for="login-pass">Password</label>
                          <input id="login-pass" name="password" type="password" required placeholder="Enter your Password">
                          @if($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                          @endif
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
                      @if(Route::has('password.request'))                      
                      <div class="col-12">
                            <p class="mb-1">
                                <a href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a>
                            </p>
                      </div>
                        @endif
                      <div class="col-12">
                        <div class="new-account align-center mt-20"> <span>New to Revolution Bike Store?</span> <a class="link" title="Register with Revolution Bike Store" href="{{ route('register') }}">Create New Account</a> </div>
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