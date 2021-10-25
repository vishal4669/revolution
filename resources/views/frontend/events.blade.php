@include('frontend.layouts.header')
      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Events</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="{{ route('home') }}">Home</a>/</li>
                <li><span>Events</span></li>
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
            <div class="col-12">
              @include('frontend.layouts.flash')
              <div class="blog-listing">
                <div class="row">
                  @foreach($events as $event)
                    <div class="col-xl-4 col-lg-6 col-12">
                      <div class="blog-item">
                        <div class="blog-media mb-20">
                          <img src="{{ $event->event_images[0]['url'] }}" alt="{{ ucfirst($event->name) }}">
                          <div class="blog-effect"></div> 
                          <a href="{{ route('event-info', $event->id) }}" title="Click to view Details" class="read">&nbsp;</a> 
                        </div>
                        <div class="blog-detail">
                          <span class="post-date">Event Date: {{ $event->event_start_day }}</span><hr>
                          <span class="post-date">Last Date to register: {{ $event->last_booking_date }}</span>
                          <div class="blog-title"><a href="single-blog.html">{{ ucfirst($event->name) }}</a></div>
                          <p>{!! Str::of($event->description)->limit(50); !!}</p>
                          <hr>
                          <!-- <div class="post-info">
                            <ul>
                              <li><span>By</span><a href="javascript:void(0)"> cormon jons</a></li>
                              <li><a href="javascript:void(0)">(5) comments</a></li>
                            </ul>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                @if($events->hasPages())
                  <div class="row">
                    <div class="col-12">
                      <div class="pagination-bar">
                        <ul>
                          @if($events->onFirstPage() == true)
                          <li><a href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
                          @else
                          <li><a href="{{ $events->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                          @endif

                          
                          @if($events->currentPage() - 1 != 0)
                            <li><a href="{{ $events->previousPageUrl() }}">{{ $events->currentPage() - 1 }}</a></li>
                          @endif
                          <li class="active"><a href="javascript:void(0)">{{ $events->currentPage() }}</a></li>
                          @if($events->currentPage() + 1 <= $events->lastPage())
                          <li><a href="{{ $events->nextPageUrl() }}">{{ $events->currentPage() + 1 }}</a></li>
                          @endif

                          @if($events->currentPage() == $events->lastPage())
                          <li><a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
                          @else
                          <li><a href="{{ $events->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
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
      </section>
      <!-- CONTAINER END --> 

      @include('frontend.layouts.footer')