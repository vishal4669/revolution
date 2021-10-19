@include('frontend.layouts.header')       
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Trainer Details</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="{{ route('home') }}">Home</a>/</li>
                <li><span>Trainer Details</span></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <!-- Bread Crumb END --> 

      <!-- CONTAIN START -->
      <section class="pt-70">
        <div class="container">
          <div class="row">
            <div class="col-xl-9 col-12">
              <div class="row">
                <div class="col-lg-5 col-md-5 mb-xs-30">
                  <div class="fotorama" data-nav="thumbs" data-allowfullscreen="native"> 
                    @foreach($trainer->photo as $photo)
                    <a href="#"><img src="{{ $photo->getUrl() }}" alt="$photo->name"></a>
                    @endforeach
                  </div>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="row">
                    <div class="col-12">
                      <div class="product-detail-main">
                        <div class="product-item-details">
                          <h1 class="product-item-name">{{ ucfirst($trainer->name) }}</h1>
                          <div class="rating-summary-block">
                            <div title="53%" class="rating-result"> <span style="width:53%"></span> </div>
                          </div>
                          <div class="price-box"> 
                              <span class="price">₹ {{$trainer->rent_month}} / Per Month -</span> 
                              </div>
                          <div class="price-box"> 
                            <span class="price">₹ {{$trainer->rent_hour}} / Per Hour</span> 
                          </div>
                          <div class="product-info-stock-sku">
                            <div>
                              <label>Type: </label>
                              <span class="info-deta">
                                {{ $trainer::TYPE_SELECT[$trainer->type] }}
                              </span> 
                            </div>
                            <div>
                              <label>Availability: </label>
                              <span class="info-deta">
                                @if($trainer->is_rented == 0)
                                  Available
                                @else
                                  Not Available
                                @endif
                              </span> 
                            </div>
                          </div>
                          <hr class="mb-20">
                          {!! Str::of($trainer->description)->limit(200); !!}
                          <ul class="product-list">
                            <li><i class="fa fa-check"></i> Fully serviced after last use</li>
                            <li><i class="fa fa-check"></i> Well Maintained</li>
                          </ul>
                          <hr class="mb-20">
                          <div class="bottom-detail cart-button">
                            <ul>
                              <li class="pro-cart-icon">
                                @if($trainer->is_rented == 0)
                                <form method="get" action="{{ route('frontend.checkout-details', ['id' => $trainer->id, 'prod' => 'trainer']) }}">
                                  <button title="Click to Rent" class="btn-color"><i class="fa fa-bicycle"></i> Rent Now</button>
                                </form>
                                @endif
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 d-none d-xl-block">
              <div class="sub-banner-block align-center">
                <img src="{{ asset('images/pro-banner.jpg') }}" alt="Revolution Bike Store">
              </div>
            </div>
          </div>
        </div>
      </section>

      <!--tab_content Start -->
      <section class="ptb-70">
        <div class="container">
          <div class="product-detail-tab">
            <div class="row">
              <div class="col-lg-12">
                <div id="tabs">
                  <ul class="nav nav-tabs">
                    <li><a class="tab-Description selected" title="Description">Description</a></li>
                    <!-- <li><a class="tab-Product-Tags" title="Product-Tags">Product-Tags</a></li> -->
                    <li><a class="tab-Reviews" title="Reviews">Reviews</a></li>
                  </ul>
                </div>
                <div id="items">
                  <div class="tab_content">
                    <ul>
                      <li>
                        <div class="items-Description selected ">
                          <div class="Description"> 
                          {!! $trainer->description !!}
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="items-Reviews">
                          <div class="comments-area">
                            <h4>Reviews<span> ({{ $trainer->comments->count() }})</span></h4>
                            <ul class="comment-list mt-30">
                            @foreach($trainer->comments as $comment)
                              <li>
                                <!-- <div class="comment-user"> <img src="images/comment-user.jpg" alt="Revolution Bike Store"> </div> -->
                                <div class="comment-detail">
                                  <div class="user-name">{{ $comment->user->full_name }}</div>
                                  <div class="post-info">
                                    <ul>
                                      <li>{{ date('d-m-Y', strtotime($comment->created_at)) }}</li>
                                      <!-- <li><a href="#"><i class="fa fa-reply"></i>Reply</a></li> -->
                                    </ul>
                                  </div>
                                  <p>{{ $comment->review }}</p>
                                </div>
                                @if($comment->reply)
                                <ul class="comment-list child-comment">
                                  <li>
                                    <!-- <div class="comment-user"> <img src="images/comment-user2.jpg" alt="Revolution Bike Store"> </div> -->
                                    <div class="comment-detail">
                                      <div class="user-name">Admin</div>
                                      <div class="post-info">
                                      </div>
                                      <p>{{ $comment->reply }}</p>
                                    </div>
                                  </li>
                                </ul>
                                @endif
                              </li>
                           @endforeach
                            </ul>
                          </div>
                          <div class="main-form mt-30">
                            <h4>Leave a Review</h4>
                            <form method="post" action="{{ route('frontend.addTrainerReview', $trainer->id) }}">
                              @csrf
                              <div class="row mt-30">
                                <div class="col-6 mb-30">
                                  <div class="rating"> 
                                    <input type="radio" name="rating" value="5" id="5" /><label for="5">☆</label> 
                                    <input type="radio" name="rating" value="4" id="4" /><label for="4">☆</label> 
                                    <input type="radio" name="rating" value="3" id="3" /><label for="3">☆</label> 
                                    <input type="radio" name="rating" value="2" id="2" /><label for="2">☆</label> 
                                    <input type="radio" name="rating" value="1" id="1" /><label for="1">☆</label>
                                  </div>
                                </div>
                                <div class="col-12 mb-30">
                                  <textarea cols="30" name="review" rows="3" placeholder="Review" required></textarea>
                                </div>
                                <div class="col-12">
                                  <button type="submit" class="btn btn-color" >Submit</button>
                                </div>
                              </div>
                            </form>
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
      </section>
      <!--tab_content End -->

      <!--Related Products Start -->
      @if(count($relatedTrainers) > 0)
        <section class="pb-70">
          <div class="container">
            <div class="product-listing">
              <div class="row">
                <div class="col-12">
                  <div class="heading-part align-center mb-30">
                    <h2 class="main_title heading"><span>Related Products</span></h2>
                  </div>
                </div>
              </div>
              <div class="pro_cat">
                <div class="row">
                  <div class="owl-carousel pro-cat-slider">
                      @foreach($relatedTrainers as $relatedtrainer)
                        <div class="item">
                            <div class="product-item">  
                              <div class="product-image"> 
                                <a href="{{ route('trainer-detail', $relatedtrainer->id) }}"> <img src="{{ $relatedtrainer->photo[0]->url }}" alt="{{ $relatedtrainer->name }}"> </a>
                              </div>
                              <div class="product-details">
                                <div class="product-item-details">
                                  <div class="product-item-name"> 
                                    <a href="{{ route('trainer-detail', $relatedtrainer->id) }}">{{ $relatedtrainer->name }}</a> 
                                  </div>
                                  <div class="price-box"> 
                                    <span class="price">₹ {{$relatedtrainer->rent_month}} / Per Month</span> 
                                  </div>
                                  <div class="price-box"> 
                                    <span class="price">₹ {{$relatedtrainer->rent_hour}} / Per Hour</span> 
                                  </div>
                                </div>
                                <div class="product-detail-inner">
                                  <div class="detail-inner-left">
                                    <ul>
                                      <li class="pro-cart-icon">
                                        <form>
                                          <button title="Rent Now"></button>
                                        </form>
                                      </li>
                                      <!-- <li class="pro-wishlist-icon"><a title="Wishlist" href="wishlist.html"></a></li>
                                      <li class="pro-compare-icon"><a title="Compare" href="compare.html"></a></li> -->
                                      <li class="pro-quick-view-icon"><a title="quick-view" href="#product_popup" class="popup-with-product"></a></li>
                                    </ul>
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
          </div>
        </section>
      @endif
      <!--Related Products End -->

      <!-- CONTAINER END --> 

      @include('frontend.layouts.footer')