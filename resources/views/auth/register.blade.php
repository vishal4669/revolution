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
                  <form class="main-form full" name="registerfrm"  method="POST" action="{{ route('register') }}">
                    <div class="personal-details mb-30">
                      <div class="row">                        
                        <div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Name and Mobile Number</h2>
                          </div>
                        </div>
                        @csrf
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="f-name" class="col-lg-3 control-label">First Name</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('fname') ? ' text-danger' : '' }}" id="f-name" name="fname" value="{{ old('fname', null) }}" required placeholder="First Name">                                
                                @if($errors->has('fname'))
                                <div class="text-danger">
                                    {{ $errors->first('fname') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="l-name" class="col-lg-3 control-label">Last Name</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('lname') ? ' text-danger' : '' }}" id="lname" name="lname" value="{{ old('lname', null) }}" required placeholder="Last Name">                                
                                @if($errors->has('lname'))
                                <div class="text-danger">
                                    {{ $errors->first('lname') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="mobile" class="col-lg-3 control-label">Mobile Number</label>
                              <div class="col-lg-9">
                                <input type="number" class="form-control {{ $errors->has('mobile') ? ' text-danger' : '' }}" id="mobile" name="mobile" value="{{ old('mobile', null) }}" required placeholder="10 Digit Mobile Number">                                
                                @if($errors->has('mobile'))
                                <div class="text-danger">
                                    {{ $errors->first('mobile') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="your-address mb-30">
                      <div class="row">
                        <div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Address</h2>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="add_1" class="col-lg-3 control-label">Address 1</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('add_1') ? ' text-danger' : '' }}" name="add_1" id="add_1" value="{{ old('add_1', null) }}" required placeholder="Address Line 1">                                
                                @if($errors->has('add_1'))
                                <div class="text-danger">
                                    {{ $errors->first('add_1') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="add_2" class="col-lg-3 control-label">Address 2</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('add_2') ? ' text-danger' : '' }}" name="add_2" id="add_2" value="{{ old('add_2', null) }}" placeholder="Address Line 2">                                
                                @if($errors->has('add_2'))
                                <div class="text-danger">
                                    {{ $errors->first('add_2') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="city" class="col-lg-3 control-label">City</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('city') ? ' text-danger' : '' }}" name="city" id="city" value="{{ old('city', 'Ahmedabad') }}" required placeholder="City">                                
                                @if($errors->has('city'))
                                <div class="text-danger">
                                    {{ $errors->first('city') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="pincode" class="col-lg-3 control-label">Pin Code</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('pincode') ? ' text-danger' : '' }}" name="pincode" id="pincode" value="{{ old('pincode', null) }}" required placeholder="Pin Code">                                
                                @if($errors->has('pincode'))
                                <div class="text-danger">
                                    {{ $errors->first('pincode') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box select-dropdown">
                            <div class="row">
                              <label for="state" class="col-lg-3 control-label">Select a State</label>
                              <div class="col-lg-9">
                                <fieldset>
                                  <select name="state" class="option-drop" id="state registerstateid">
                                    <option value="">Select a State</option>
                                    <option value="AP">Andhra Pradesh</option>
                                    <option value="AR">Arunachal Pradesh</option>
                                    <option value="AS">Assam</option>
                                    <option value="BR">Bihar</option>
                                    <option value="CT">Chhattisgarh</option>
                                    <option value="GA">Goa</option>
                                    <option value="GJ" selected>Gujarat</option>
                                    <option value="HR">Haryana</option>
                                    <option value="HP">Himachal Pradesh</option>
                                    <option value="JK">Jammu and Kashmir</option>
                                    <option value="JH">Jharkhand</option>
                                    <option value="KA">Karnataka</option>
                                    <option value="KL">Kerala</option>
                                    <option value="MP">Madhya Pradesh</option>
                                    <option value="MH">Maharashtra</option>
                                    <option value="MN">Manipur</option>
                                    <option value="ML">Meghalaya</option>
                                    <option value="MZ">Mizoram</option>
                                    <option value="NL">Nagaland</option>
                                    <option value="OR">Orissa</option>
                                    <option value="PB">Punjab</option>
                                    <option value="RJ">Rajasthan</option>
                                    <option value="SK">Sikkim</option>
                                    <option value="TN">Tamil Nadu</option>
                                    <option value="TS">Telangana</option>
                                    <option value="TR">Tripura</option>
                                    <option value="UK">Uttarakhand</option>
                                    <option value="UP">Uttar Pradesh</option>
                                    <option value="WB">West Bengal</option>
                                    <option value="AN">Andaman and Nicobar Islands</option>
                                    <option value="CH">Chandigarh</option>
                                    <option value="DN">Dadar and Nagar Haveli</option>
                                    <option value="DD">Daman and Diu</option>
                                    <option value="DL">Delhi</option>
                                    <option value="LD">Lakshadeep</option>
                                    <option value="PY">Pondicherry (Puducherry)</option>
                                  </select>
                                </fieldset>
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
                            <h2 class="form-title heading">Your Username & Email</h2>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="username" class="col-lg-3 control-label">Username</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control {{ $errors->has('username') ? ' text-danger' : '' }}" id="username" value="{{ old('username', null) }}" name="username" placeholder="Username">                                
                                @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="login-email" class="col-lg-3 control-label">Email address</label>
                              <div class="col-lg-9">
                                <input type="email" class="form-control {{ $errors->has('email') ? ' text-danger' : '' }}" name="email" id="email" value="{{ old('email', null) }}" placeholder="Email address">                                
                                @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
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
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' text-danger' : '' }}" id="login-pass"  placeholder="Enter your Password">                                
                                @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="re-enter-pass" class="col-lg-3 control-label">Re-enter Password</label>
                              <div class="col-lg-9">
                                <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' text-danger' : '' }}" id="password_confirmation"  placeholder="Re-enter your Password">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="Submit-btn">
                      <div class="row">
                        <div class="col-12">                       
                          <button type="submit" class="btn-color right-side">Submit</button>
                        </div>
                        <div class="col-12">
                          <hr>
                          <div class="new-account align-center mt-20"> <span>Already have an account with us</span> <a class="link" title="Login to your account" href="{{route('login')}}">Login Here</a> </div>
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
                    username:"required",
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