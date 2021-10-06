@include('frontend.layouts.header') 
      
      <!-- BANNER STRAT -->
      <section class="banner-main container-full-sm">
        <div class="banner">
          <div class="main-banner owl-carousel">
            <div class="item">
              <div class="banner-1"> <img src="{{ asset('frontend/images/training01.jpg') }}" alt="Revolution Bike Store">
                <div class="banner-detail align-center">
                  <div class="container">
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-7 col-xl-40per">
                        <div class="banner-detail-inner"> 
                          <span class="slogan">Book Your Training Schedule</span>
                          <h1 class="banner-title">REAL TRAINING </br>REAL RESULTS</h1>
                          <div class="sub-title">Achieve your goals and train with your friends.
                                                  Our structured training and data analysis will take your
                                                  cycling and running fitness to the next level.</div>
                          <a class="btn btn-color mt-30" href="{{ route('frontend.bookTrainerCafe') }}">Book your slot</a>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-5 col-xl-60per"></div>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- BANNER END --> 
      
      <!-- CONTAIN START -->

      
      
      <section class="ptb-70">
        <div class="container">
          <div class="row m-0">
            <div class="col-xl-6 p-0">
              <div class="offer-img">
                <img src="{{ asset('frontend/images/img-1.png') }}" alt="Revolution Bike Store">
              </div>
            </div>
            <div class="col-xl-6 white-bg center-sm p-0">
              <div class="offer-detail">
                <div class="row">
                  <div class="col-12 ">
                    <div class="heading-part mb-30 mb-sm-15">
                      <h2 class="main_title heading"><span>1,000+</br>
STRUCTURED</br>
WORKOUTS</br></br></span></h2>
                    </div>
                  </div>
                </div>
                <div class="offer-inner-details">
                  <div class="offer-title">Hop on Zwift for an effective and heart-pumping

workout based on your goals and time. Geared to your ability,

the guided intervals are easy to follow and challenging to do.

Build on your strengths and target weaknesses with some of the best

coaches in the world. They’ve got the wins to help you get yours.

</div>
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="ptb-70">
        <div class="container">
          <div class="row m-0">
            
            <div class="col-xl-6 white-bg center-sm p-0">
              <div class="offer-detail">
                <div class="row">
                  <div class="col-12 ">
                    <div class="heading-part mb-30 mb-sm-15">
                      <h2 class="main_title heading"><span>FLEXIBLE</br>
TRAINING PLANS</br></br></span></h2>
                    </div>
                  </div>
                </div>
                <div class="offer-inner-details">
                  <div class="offer-title">Need a long-term strategy for your next event?

Start a training plan and smash it. Our cycling and

running plans are crafted by race-winning coaches and

tailored to your fitness level. And they’ll adjust around your schedule.

Get your workouts done, no matter how busy life gets.

</div>
                  
                </div>
                
              </div>
            </div>


            <div class="col-xl-6 p-0">
              <div class="offer-img">
                <img src="{{ asset('frontend/images/img-2.png') }}" alt="Revolution Bike Store">
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- SUB-BANNER START -->
      <section class="pt-70">
        <div class="sub-banner-block">
          <div class="container">
            <div class=" center-sm">
              <div class="row m-0">
                <div class="col-md-6 col-12 p-0">
                  <div class="sub-banner sub-banner1" >
                    <img alt="Revolution Bike Store" src="{{ asset('frontend/images/package01.jpg') }}">
                    <div class="sub-banner-detail">
                      <span class="sub-banner-slogan">Build Me Up</span>
                      <div class="sub-banner-title sub-banner-title-color">Make a big leap</br> in fitness if you’re</br> tight on time.</div>
                      <a class="btn btn-color mt-10" href="shop.html">5-8 weeks</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12 mt-xs-30 p-0">
                  <div class="sub-banner sub-banner2" >
                    <img alt="Revolution Bike Store" src="{{ asset('frontend/images/package02.jpg') }}">
                    <div class="sub-banner-detail">
                      <span class="sub-banner-slogan">TT-TUNE UP</span>
                      <div class="sub-banner-title sub-banner-title-color">Maximize your</br> aerobic power and</br> lift your top end.</div>
                      <a class="btn btn-color mt-10 " href="shop.html">4-6 weeks</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- SUB-BANNER END -->     

      <!-- CONTAINER END -->
      @include('frontend.layouts.footer')  
