@include('frontend.layouts.header')
       
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">{{ $event_info->name}}</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="{{ route('home') }}">Home</a>/</li>
                <li><a href="{{ route('allevents') }}">Events</a>/</li>
                <li><span>{{ $event_info->name}}</span></li>
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
            <div class="col-lg-9">
              <div class="row">
                <div class="col-12 mb-60">
                  <div class="blog-media mb-20"> 
                    <img src="{{ $event_info->event_images[0]->url }}" alt="Roadie"> 
                  </div>
                  <div class="blog-detail ">
                  <!--   <div class="post-info">
                      <ul>
                        <li><span class="post-date">03 jan 2018</span></li>
                        <li><span>By</span><a href="javascript:void(0)"> cormon jons</a></li>
                      </ul>
                    </div> -->
                    <div class="blog-title"><a href="javascript:void(0)">{{ $event_info->name }}</a> <br>
                    <a href="javascript:void(0)">Event Date: {{ $event_info->event_start_day }}</a> <br>
                    <a href="javascript:void(0)">Registration Ends: {{ $event_info->last_booking_date }}</a></div>
                    <label for="description">Details</label> {!! $event_info->description !!}
                    <label for="terms">Terms</label> {!! $event_info->terms !!}
                    <hr>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-12">
                  <div class="comments-area-main">
                    <div class="comments-area">
                      <h4>Comments<span>(2)</span></h4>
                      <ul class="comment-list mt-20">
                    <li>
                      <div class="comment-user"> <img src="images/comment-user.jpg" alt="Roadie"> </div>
                      <div class="comment-detail">
                        <div class="user-name">John Doe</div>
                        <div class="post-info">
                          <ul>
                            <li>Fab 07, 2018</li>
                            <li><a href="javascript:void(0)"><i class="fa fa-reply"></i>Reply</a></li>
                          </ul>
                        </div>
                        <p>Consectetur adipiscing elit integer sit amet augue laoreet maximus nuncac.</p>
                      </div>
                      <ul class="comment-list child-comment">
                        <li>
                          <div class="comment-user"> <img src="images/comment-user2.jpg" alt="Roadie"> </div>
                          <div class="comment-detail">
                            <div class="user-name">Joseph</div>
                            <div class="post-info">
                              <ul>
                                <li>Fab 07, 2018</li>
                                <li><a href="javascript:void(0)"><i class="fa fa-reply"></i>Reply</a></li>
                              </ul>
                            </div>
                            <p>Consectetur adipiscing elit integer sit amet augue laoreet maximus nuncac.</p>
                          </div>
                        </li>
                        <li>
                          <div class="comment-user"> <img src="images/comment-user2.jpg" alt="Roadie"> </div>
                          <div class="comment-detail">
                            <div class="user-name">Joseph</div>
                            <div class="post-info">
                              <ul>
                                <li>Fab 07, 2018</li>
                                <li><a href="javascript:void(0)"><i class="fa fa-reply"></i>Reply</a></li>
                              </ul>
                            </div>
                            <p>Consectetur adipiscing elit integer sit amet augue laoreet maximus nuncac.</p>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <div class="comment-user"> <img src="images/comment-user3.jpg" alt="Roadie"> </div>
                      <div class="comment-detail">
                        <div class="user-name">Kennedy</div>
                        <div class="post-info">
                          <ul>
                            <li>Fab 07, 2018</li>
                            <li><a href="javascript:void(0)"><i class="fa fa-reply"></i>Reply</a></li>
                          </ul>
                        </div>
                        <p>Consectetur adipiscing elit integer sit amet augue laoreet maximus nuncac.</p>
                      </div>
                    </li>
                    </ul>
                    </div>
                    <div class="main-form mt-30">
                      <h4>Leave a comments</h4>
                      <form >
                        <div class="row mt-30">
                          <div class="col-md-4 mb-30">
                            <input type="text" placeholder="Name" required>
                          </div>
                          <div class="col-md-4 mb-30">
                            <input type="email" placeholder="Email" required>
                          </div>
                          <div class="col-md-4 mb-30">
                            <input type="text" placeholder="Website" required>
                          </div>
                          <div class="col-12 mb-30">
                            <textarea cols="30" rows="3" placeholder="Message" required></textarea>
                          </div>
                          <div class="col-12">
                            <button class="btn btn-color" name="submit" type="submit">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="col-lg-3">
              <div class="sidebar-block">
                <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                    <div class="sidebar-title">
                      <h3><span>Tickets</span></h3>
                    </div>
                    <div class="sidebar-contant">
                      <ul>
                      @auth
                        @if(count($tickets) == 0)
                          <li>Tickets not available at this time...</li>
                        @else
                        <form method="post" action="{{ route('frontend.tickets-payment') }}">
                          @csrf
                          <li>
                            <div class="input-box select-dropdown">
                              <fieldset>
                                <select id="ticket_id" name="ticket_id" class="option-drop" required>
                                  <option selected="" value="">Select Ticket Type</option>
                                    @foreach($tickets as $ticket)
                                      <option value="{{ $ticket->id }}">{{ $ticket->ticket_name }} - {{ $ticket->ticket_price }}</option>
                                    @endforeach
                                </select>
                              </fieldset>
                            </div>
                          </li>
                          <br>
                          <li>
                            <div class="input-box select-dropdown">
                              <fieldset>
                                <select id="quantity" name="quantity" class="option-drop" required>
                                  <option selected="" value="">Select Quantity</option>
                                  <option value="1"> 1 </option>
                                  <option value="2"> 2 </option>
                                  <option value="3"> 3 </option>
                                  <option value="4"> 4 </option>
                                  <option value="5"> 5 </option>
                                </select>
                              </fieldset>
                            </div>
                          </li>
                          <br>
                          <li>
                            <button title="Click to Rent" class="btn-grey btn-block"><i class="fa fa-ticket"></i> Buy Tickets</button>
                          </li>                          
                          </form>
                        @endif
                      @else
                        <li class="text-center">Login/Register to buy tickets</li>
                        <li class="text-center">
                        <button class="btn btn-warning" ><a href="{{ route('login') }}"> Login </a></button>
                        <button class="btn btn-warning" ><a href="{{ route('register') }}"> Register </a></button></li>
                      @endauth
                      </ul>

                    </div>
                  </div>
                  <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                    <div class="sidebar-title">
                      <h3><span>Date & Time</span></h3>
                    </div>
                    <div class="sidebar-contant">
                      <ul>
                        <li>
                          <div> 
                            <span>
                              <label for="event_start_day">Event Date: {{ $event_info->event_start_day }}</span></label>
                            </span>
                          </div>
                        </li>
                        <li>
                          <div> 
                            <span>
                              <label for="time">Reporting Time: {{ $event_info->reporting_time }}</span></label>
                            </span>
                          </div>
                        </li>
                        <li>
                          <div> 
                            <span>
                              <label for="time">Start Time: {{ $event_info->start_time }}</span></label>
                            </span>
                          </div>
                        </li>
                        <li>
                          <div> 
                            <span>
                              <label for="last_booking_date">Register before: {{ $event_info->last_booking_date }}</span></label>
                            </span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                    <div class="sidebar-title">
                      <h3><span>Location</span></h3>
                    </div>
                    <div class="sidebar-contant">
                      <ul>
                        <li>
                          <div> 
                            <span>
                              <label for="location">Location: {{ $event_info->location }}</span></label>
                            </span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  @if(count($upcoming_events) > 0)
                    <div class="sidebar-box sidebar-item sidebar-item-wide"> <span class="opener plus"></span>
                      <div class="sidebar-title">
                        <h3><span>Upcoming Events</span></h3>
                      </div>
                      <div class="sidebar-contant">
                        <ul>
                          @foreach($upcoming_events as $upcoming_event)
                            <li>
                              <div class="pro-media"> <a href="{{ route('event-info', $upcoming_event->id) }}"><img alt="{{ $upcoming_event->name }}" src="{{ $upcoming_event->event_images[0]->url }}"></a> </div>
                              <div class="pro-detail-info"> <a href="{{ route('event-info', $upcoming_event->id) }}">{{ $upcoming_event->name }}</a>
                                <div class="post-info">{{ $upcoming_event->event_start_day }}</div>
                              </div>
                            </li>
                          @endforeach
                        </ul>
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