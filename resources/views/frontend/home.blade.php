@include('frontend.layouts.header') 
      
      <!-- BANNER STRAT -->
      <section class="banner-main container-full-sm">
        <div class="banner">
          <div class="main-banner owl-carousel">
            <div class="item">
              <div class="banner-1"> <img src="frontend/images/banner1.jpg" alt="Revolution Bike Store">
                <div class="banner-detail align-center">
                  <div class="container">
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-7 col-xl-40per">
                        <div class="banner-detail-inner"> 
                          <span class="slogan">Best Collection of Bikes</span>
                          <h1 class="banner-title">Revolution Bike Store</h1>
                          <div class="sub-title"> range of all types of cycles and accessories. Visit shop to buy now.</div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-5 col-xl-60per"></div>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            <div class="item">
              <div class="banner-2"> <img src="frontend/images/banner2.jpg" alt="Revolution Bike Store">
                <div class="banner-detail  align-center">
                  <div class="container">
                    <div class="row"> 
                      <div class="col-xl-6 col-lg-6 col-5"></div>
                      <div class="col-xl-6 col-lg-6 col-7">
                        <div class="banner-detail-inner">
                          <span class="slogan">Experience before you buy.</span>
                          <h1 class="banner-title">Rent High-end Cycles Now</h1>
                          <div class="sub-title">Wide range of High End Bikes for Rent in Ahmedabad</div>
                          <a class="btn btn-color mt-30" href="{{ route('rent-cycles') }}">Rent Now!</a>
                        </div> 
                      </div>             
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="banner-3"> <img src="frontend/images/banner3.jpg" alt="Revolution Bike Store">
                <div class="banner-detail  align-center">
                  <div class="container">
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-5"></div>
                      <div class="col-xl-6 col-lg-6 col-7">
                        <div class="banner-detail-inner">
                          <span class="slogan">Modern Bicycle</span>
                          <h1 class="banner-title">Revolution Bike Store Race Bicycle</h1>
                          <div class="sub-title"> Latest Bicycle models, prices, current news, Bicycle comparisons</div>
                        <a class="btn btn-color mt-30" href="shop.html">Shop Now!</a>
                        </div>
                      </div>
                      <div class="col-xl-5 col-4"></div>
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

      <!-- SUB-BANNER START -->
      <section class="pt-70">
        <div class="sub-banner-block">
          <div class="container">
            <div class=" center-sm">
              <div class="row m-0">
                <div class="col-md-6 col-12 p-0">
                  <div class="sub-banner sub-banner1" >
                    <img alt="Revolution Bike Store" src="frontend/images/sub-banner1.jpg">
                    <div class="sub-banner-detail">
                      <span class="sub-banner-slogan">Rent Cycles</span>
                      <div class="sub-banner-title sub-banner-title-color">Cycles Rent Start <br/>From 3000</div>
                      <a class="btn btn-color mt-10" href="{{ route('rent-cycles') }}">View Cycles</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12 mt-xs-30 p-0">
                  <div class="sub-banner sub-banner2" >
                    <img alt="Revolution Bike Store" src="frontend/images/sub-banner2.jpg">
                    <div class="sub-banner-detail">
                      <span class="sub-banner-slogan">Rent Trainers</span>
                      <div class="sub-banner-title sub-banner-title-color">Rent Trainers <br/>Rent starts from 9000</div>
                      <a class="btn btn-color mt-10 " href="{{ route('rent-trainers') }}">View Trainers</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- SUB-BANNER END -->

      <!--  Featured Products Slider Block Start  -->
      <div class="featured-product ptb-70">
        <div class="container">
          <div class="product-listing">
            <div class="row">
              <div class="col-12">
                <div class="heading-part align-center mb-30">
                  <h2 class="main_title heading">Our Products</h2>
                  <div id="tabs" class="category-bar mt-20">
                    <ul class="tab-stap">
                      <li><a class="tab-step1 selected" title="step1">Cycles</a></li>
                        <li>-</li>
                      <li><a class="tab-step2" title="step2">Trainers</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="pro_cat tab_content ">
              <div id="items">
                <div class="">
                  <ul>
                    <li>
                      <div id="data-step1" class="items-step1 product-slider-main position-r selected" data-temp="tabdata">
                        <div class="tab_cat">
                          <div class="row">
                            <div class="owl-carousel tab_slider">
                            @foreach($cycles as $cycle) 
                              <div class="item">
                                <div class="product-item">
                                  <!--<div class="main-label sale-label"><span>Sale</span></div>-->
                                  <div class="product-image"> 
                                   <a href="{{ route('cycle-detail', $cycle->id) }}"> <img src="{{ $cycle->photo[0]->url }}" alt="Revolution Bike Store"> </a>
                                    <div class="product-detail-inner">
                                      <div class="detail-inner-left">
                                        <ul>
                                          <li class="pro-cart-icon">
                                            <form method="get" action="{{ route('cycle-detail', $cycle->id) }}">
                                              <button type="submit" title="Click to Rent"></button>
                                            </form>
                                          </li>
                                          <!--<li class="pro-wishlist-icon"><a title="Wishlist" href="wishlist.html"></a></li>
                                          <li class="pro-compare-icon"><a title="Compare" href="compare.html"></a></li>
                                          <li class="pro-quick-view-icon"><a title="quick-view" href="#product_popup" class="popup-with-product"></a></li>-->
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="product-details">
                                    <div class="product-item-details">
                                      <div class="product-item-name"> 
                                        <a href="{{ route('cycle-detail', $cycle->id) }}">{{$cycle->name}}</a> 
                                      </div>
                                     <!-- <div class="rating-summary-block">
                                        <div class="rating-result" title="53%"> <span style="width:53%"></span> </div>
                                      </div>-->
                                      <div class="price-box"> 
                                        <span class="price">₹ {{$cycle->rent_month}} / Per Month</span> 
                                      </div>
                                      <div class="price-box"> 
                                        <span class="price">₹ {{$cycle->rent_hour}} / Per Hour</span> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata">
                        <div class="tab_cat">
                          <div class="row">
                            <div class="owl-carousel tab_slider">
                             @foreach($trainers as $trainer) 
                              <div class="item">
                                <div class="product-item">
                                  <!--<div class="main-label new-label"><span>New</span></div>-->
                                  <div class="product-image"> 
                                   <a href="{{ route('trainer-detail', $trainer->id) }}"> <img src="{{ $trainer->photo[0]->url }}" alt="{{$cycle->name}}"> </a>
                                    <div class="product-detail-inner">
                                      <div class="detail-inner-left">
                                        <ul>
                                          <li class="pro-cart-icon">
                                            <form method="get" action="{{ route('trainer-detail', $trainer->id) }}">
                                              <button type="submit" title="Click to Rent"></button>
                                            </form>
                                          </li>
                                          <!--<li class="pro-wishlist-icon"><a title="Wishlist" href="wishlist.html"></a></li>
                                          <li class="pro-compare-icon"><a title="Compare" href="compare.html"></a></li>-->
                                          <li class="pro-quick-view-icon"><a title="quick-view" href="#product_popup" class="popup-with-product"></a></li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="product-details">
                                    <div class="product-item-details">
                                      <div class="product-item-name"> 
                                        <a href="{{ route('trainer-detail', $trainer->id) }}">{{$trainer->name}}</a> 
                                      </div>
                                      <!-- <div class="rating-summary-block">
                                        <div class="rating-result" title="53%"> <span style="width:53%"></span> </div>
                                      </div> -->
                                      <div class="price-box"> 
                                        <span class="price">₹ {{$trainer->rent_month}} / Per Month</span> 
                                      </div>
                                      <div class="price-box"> 
                                        <span class="price">₹ {{$trainer->rent_hour}} / Per Hour</span><br> 
                                        <span>(Hourly option only for use at Cafe)</span>
                                      </div>   
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  Featured Products Slider Block End  -->

      <!--Testimonial Block Start -->
      <section class="client-bg ptb-30">
        <div class="top-shadow">
          <img alt="Revolution Bike Store" src="frontend/images/top-shadow.png">
        </div>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="client-main style-03 client-bg">
                  <div class="client-inner align-center">
                    <div id="client" class="owl-carousel">
                        @foreach($testimonials as $testimonial)
                      <div class="item client-detail">
                        <div class="quote">
                        <div class="quote1-img">
                          <img src="frontend/images/quote1.png" alt="Revolution Bike Store">
                        </div>
                        <p>{{ $testimonial->testimonial }}</p>
                        <div class="quote2-img">
                          <img src="frontend/images/quote2.png" alt="Revolution Bike Store">
                        </div>
                      </div>
                        <div class="client-img">
                          <img alt="Revolution Bike Store" src="{{$testimonial->user_photo->getUrl()}}"> 
                          <div class="designation">{{ ucfirst($testimonial->user->full_name) }}</div>
                        </div>

                      </div>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- <div class="bottom-shadow">
          <img alt="Revolution Bike Store" src="{{ asset('frontend/images/bottom-shadow.png') }}">
        </div> -->
      </section>
      <!--Testimonial Block End -->

      <!--Blog Block Start -->
      
      <!--Blog Block End -->

      <!-- Brand logo block Start  -->
      <div class="brand-logo ptb-70">
        <div class="container">
          <div class="row">
            <div class="col-12 ">
              <div class="heading-part align-center mb-30">
                <h2 class="main_title heading"><span>Brands We Sell</span></h2>
              </div>
            </div>
          </div>
          <div class="row brand">
            <div class="col-md-12">
              <div id="brand-logo" class="owl-carousel align_center">
                @foreach($brands as $brand)
                <div class="item"><a href="javascript:void(0)"><img src="{{ $brand->logo->getUrl() }}" alt="{{$brand->name}}"></a></div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Brand logo block End  -->

      <!-- CONTAINER END -->

    @include('frontend.layouts.footer') 