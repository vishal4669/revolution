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
            <h1 class="banner-title">Register</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
                <li><span>Register</span></li>
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
                <div class="col-xl-8 col-lg-8 col-md-8 ">
                  <div class="row">
                    <div class="col-12 mb-20">
                      <div class="heading-part heading-bg">
                        <h2 class="heading">Create your account</h2>
                      </div>
                    </div>
                  </div>
                  <form class="main-form full" name="registerfrm"  method="POST" action="{{ route('signup.create') }}">
                    <div class="personal-details mb-30">
                      <div class="row">
                        <!--<div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Personal Details</h2>
                          </div>
                        </div> -->
                        @csrf
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="name" class="col-lg-3 control-label">Username</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Username">
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="login-email" class="col-lg-3 control-label">Email address</label>
                              <div class="col-lg-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email address">
                              </div>
                            </div>
                          </div>
                        </div>                     

                      </div>
                    </div>
              
                    <div class="your-address">
                      <div class="row">
                        <div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Password</h2>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="login-pass" class="col-lg-3 control-label">Password</label>
                              <div class="col-lg-9">
                                <input type="password" name="password" class="form-control" id="login-pass"  placeholder="Enter your Password">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="re-enter-pass" class="col-lg-3 control-label">Re-enter Password</label>
                              <div class="col-lg-9">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password"  placeholder="Re-enter your Password">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="Submit-btn">
                      <div class="row">
                        <div class="col-12">
                       
                          <button name="submit" type="submit" class="btn-color right-side">Submit</button>
                        </div>
                        <div class="col-12">
                          <hr>
                          <div class="new-account align-center mt-20"> <span>Already have an account with us</span> <a class="link" title="Register with Beaox" href="{{route('signin.index')}}">Login Here</a> </div>
                        </div>
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

       <script type="text/javascript">  

          $(document).ready(function(){
              // Initialize form validation on the registration form.
                // It has the name attribute "registration"
                $("form[name='registerfrm']").validate({
                  // Specify validation rules
                  rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    name:"required",
                    email: {
                      required : true,
                      email : true
                    },
                    password: {
                      minlength : 6,
                      required : true, 
                    },
                    confirm_password: {
                        minlength : 6,
                        equalTo : "#confirm_password"
                      }
                    
                  },
                  // Specify validation error messages
                  messages: {
                    name:"Please enter your name",
                    email:{
                      required : "Please enter your email address",
                      email : "Please enter valid email address"
                    },
                    password: 
                    {
                      required : "Please enter password",
                      minlength : "Password should be greater then or equal to 6 digits"
                    },
                    confirm_password: 
                    {
                      required : "Please enter password",
                      minlength : "Password should be greater then or equal to 6 digits",
                      equalTo : "Password and confirm password should be same",
                    }
                    
                  },
                  // Make sure the form is submitted to the destination defined
                  // in the "action" attribute of the form when valid
                  submitHandler: function(form) {
                    form.submit();
                  }
                });
          });
      </script>