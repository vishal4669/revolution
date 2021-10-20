
@include('frontend.layouts.header') 
      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Rent Cycles</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="{{ route('home') }}">Home</a>/</li>
                <li><span>Cycles</span></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <!-- Bread Crumb END -->  
      
      <!-- CONTAIN START -->
      <section class="ptb-70">
        <div class="container">
          <div class="row">
            <div class="">
              <div class="sidebar-block shop-list">
                <div class="sidebar-box mb-40 d-none d-lg-block"> 
                  <a href="javascript:void(0)"> 
                    <img src="images/left-banner.jpg" alt="Revolution Bike Store"> 
                  </a> 
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="shorting shorting-style-2  mb-30">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="view">
                      <div class="list-types grid active "> 
                        <a>
                          <div class="grid-icon list-types-icon"></div>
                        </a> 
                      </div>
                      <div class="list-types list"> 
                        <a>
                          <div class="list-icon list-types-icon"></div>
                        </a> 
                      </div>
                    </div>
                    <div class="short-by"> <span>Sort By :</span>
                      <div class="select-item select-dropdown">
                        <fieldset>
                          <select  name="speed" id="sort-price" class="option-drop">
                            <option value="" selected="selected">Name (A to Z)</option>
                            <option value="">Name(Z - A)</option>
                            <option value="">price(low&gt;high)</option>
                            <option value="">price(high &gt; low)</option>
                            <option value="">rating(highest)</option>
                            <option value="">rating(lowest)</option>
                          </select>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="show-item float-left-sm"> <span>Show :</span>
                      <div class="select-item select-dropdown">
                        <fieldset>
                          <select  name="speed" id="show-item" class="option-drop">
                            <option value="" selected="selected">24</option>
                            <option value="">12</option>
                            <option value="">6</option>
                          </select>
                        </fieldset>
                      </div>
                      <span>Per Page</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="product-listing grid-type">
                <div class="inner-listing">
                  <div class="row">
                  @foreach($cycles as $cycle)
                  <div class="col-lg-3 col-md-4 col-6 item-width mb-30">
                      <div class="product-item">
                        <div class="row">
                          <div class="img-col col-12">
                            <div class="product-image"> 
                              <a href="{{ route('cycle-detail', $cycle->id) }}"> 
                                <img src="{{$cycle->photo[0]['url']}}" alt="{{$cycle->name}}"> 
                              </a>
                              <div class="product-detail-inner">
                                <div class="detail-inner-left">
                                  <ul>
                                    <li class="pro-cart-icon">
                                      <form method="get" action="{{ route('cycle-detail', $cycle->id) }}">
                                        <button type="submit" title="Click to View"></button>
                                      </form>
                                    </li>
                                    <!-- <li class="pro-wishlist-icon"><a title="Wishlist" href="wishlist.html"></a></li>
                                    <li class="pro-compare-icon"><a title="Compare" href="compare.html"></a></li>
                                    <li class="pro-quick-view-icon"><a title="quick-view" href="#product_popup" class="popup-with-product"></a></li> -->
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="detail-col col-12">
                            <div class="product-details">
                              <div class="product-item-details">
                                <div class="product-item-name"> 
                                  <a href="{{ route('cycle-detail', $cycle->id) }}">{{$cycle->name}}</a> 
                                </div>
                                <div class="rating-summary-block">
                                  @if($cycle->is_rented == 0)
                                  Available
                                @else
                                  Not Available
                                @endif
                                </div>
                                <div class="price-box"> 
                                  <span class="price">₹ {{$cycle->rent_month}} / Per Month</span> 
                                </div>
                                <div class="product-des">
                                  {!! $cycle->description !!}
                                </div>
                                <div class="product-detail-inner">
                                  <div class="detail-inner-left">
                                    <ul>
                                      <li class="pro-cart-icon">
                                        <form method="get" action="{{ route('cycle-detail', $cycle->id) }}">
                                        <button type="submit" title="Click to View"></button>
                                      </form>
                                      </li>
                                      <!-- <li class="pro-wishlist-icon"><a title="Wishlist" href="wishlist.html"></a></li>
                                      <li class="pro-compare-icon"><a title="Compare" href="compare.html"></a></li>
                                      <li class="pro-quick-view-icon"><a title="quick-view" href="#product_popup" class="popup-with-product"></a></li>-->
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>    
                      </div>
                    </div>
                  @endforeach
                  </div>
                @if($cycles->hasPages())
                  <div class="row">
                    <div class="col-12">
                      <div class="pagination-bar">
                        <ul>
                          @if($cycles->onFirstPage() == true)
                          <li><a href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
                          @else
                          <li><a href="{{ $cycles->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                          @endif

                          
                          @if($cycles->currentPage() - 1 != 0)
                            <li><a href="{{ $cycles->previousPageUrl() }}">{{ $cycles->currentPage() - 1 }}</a></li>
                          @endif
                          <li class="active"><a href="javascript:void(0)">{{ $cycles->currentPage() }}</a></li>
                          @if($cycles->currentPage() + 1 <= $cycles->lastPage())
                          <li><a href="{{ $cycles->nextPageUrl() }}">{{ $cycles->currentPage() + 1 }}</a></li>
                          @endif

                          @if($cycles->currentPage() == $cycles->lastPage())
                          <li><a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
                          @else
                          <li><a href="{{ $cycles->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- CONTAINER END --> 

      @include('frontend.layouts.footer') 
