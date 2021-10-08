@include('frontend.layouts.header')      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Book Slot</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
                <li><span>Book Slot</span></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <!-- Bread Crumb END -->

      <section class="ptb-70">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-part align-center mb-30">
                <h2 class="main_title  heading"><span>Trainer Booking for Cafe</span></h2>
              </div>
            </div>
          </div>
       
           <!-- CONTAIN START -->
      <section class="checkout-section ">
        <div class="container">
          <div class="row">
            <div class="col-8">
              <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-8 col-md-8 ">
                  <div class="row">
                  </div>
                  <form class="main-form full" action="{{ route('frontend.book-slot') }}" method="POST">
                    @csrf
                    <div class="personal-details mb-30">
                      <div class="row">
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="f-name" class="col-lg-3 control-label">Booking Date</label>
                              <div class="col-lg-8">
                                <input type="text" class="form-control" autocomplete="off" id="booking_date" name="booking_date" required placeholder="Booking Date">
                              </div>
                            </div>
                          </div>

                          <div class="col-12 mb-20 align-center">
                            <div class="heading-part heading-bg">
                              <h2 class="heading">Available Slots</h2>
                            </div>
                        </div>  

                          <div class="input-box">
                            <div class="row">
                              <div class="col-lg-12 align-center">
                                  <div class="mb-2">
                                    @php ($i = 0)
                                      @foreach($slots as $slot)
                                        @if($i%4 == 0)
                                          </div>
                                          <div class="mb-2">
                                        @endif
                                          <button onclick="set_slot(this)" name="{{ $slot->slot_start_time }}-{{ $slot->slot_end_time }}" id="{{ $slot->id }}" type="button" class="btn btn-outline-info timeslot_label">{{ $slot->slot_start_time }}-{{ $slot->slot_end_time }}</button>
                                        @php ($i++)                              
                                      @endforeach
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="Submit-btn">
                      <div class="row">
                        <div class="col-12">
                         
                          <div class="new-account align-center">
                            <button name="submit" id="submit" onclick="book_slot();" type="submit" class="btn-success align-center">Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-4">
            <div class="sidebar-block">
                <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                    <div class="sidebar-title">
                      <h3><span>Your Packages</span></h3>
                    </div>
                    <div class="sidebar-contant">
                      <ul>
                        @if($userPackages != "")                        
                        <table class="table table-bordered">
                          <thead>
                            <th>
                              Package Name
                            </th>
                            <th>
                              Available Hours
                            </th>
                            <th>
                              Expiry Date
                            </th>                            
                          </thead>
                          <tbody>
                          @foreach($userPackages as $userPackage)
                            <tr>
                              <td>{{ $userPackage->package_name }}</td>
                              <td>{{ $userPackage->total_hours }}</td>
                              <td>{{ date('d-m-Y', strtotime($userPackage->created_at)) }}</td>
                            </tr>
                          @endforeach                              
                          </tbody>
                        </table>
                        @else
                        <li>You have not subscribed to any package.</li>
                        @endif
                      </ul>

                    </div>
                  </div>

                  @if($userPackages == "")
                  <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                    <div class="sidebar-title">
                      <h3><span>Rate per booking</span></h3>
                    </div>
                    <div class="sidebar-contant">
                      <ul>
                        <li>
                          <div> 
                            <span>
                              <label for="location">Hourly Booking Rates</span></label>
                            </span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  @endif

                  @if(count($booked_slots) > 0)
                  <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                    <div class="sidebar-title">
                      <h3><span>Upcoming Bookings</span></h3>
                    </div>
                    <div class="sidebar-contant">
                      <ul>
                        @if($userPackages != "")
                        <table class="table table-bordered">
                          <thead>
                            <th>
                              Date
                            </th>
                            <th>
                              Hrs Used
                            </th>
                          </thead>
                          <tbody>
                            @foreach($booked_slots as $booked_slot)
                            <tr>
                              <td>
                                {{  date('d-m-Y', strtotime($booked_slot->date)) }}
                              </td>
                              <td>
                                {{ $booked_slot->hrs_used }}
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>  
                        <th></th>
                        @else
                          <li>
                            <div> 
                              <span>
                                <label>No last bookings found.</span></label>
                              </span>
                            </div>
                          </li>
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
       
        </div>
      </section>
      <!-- CONTAINER END --> 
      
@include('frontend.layouts.footer')

<script type="text/javascript">
  function set_slot(time_val){
    $( ".timeslot_label" ).removeClass(" active");
    $( "#"+time_val.id ).addClass(" active");
    $("#submit") .val(time_val.id);

  }
    
    $(document).ready(function(){  

        $('#booking_date').datepicker({
            format: "dd-mm-yyyy",
            startDate : new Date(),
            todayHighlight: 'TRUE',
            autoclose: true,
            orientation: "bottom",
            onSelect:function(dateText,instance){
            console.log(dateText); //Latest selected date will give the alert.
            $.post("test.php", {
            date:dateText // now you will get the selected date to `date` in your post
            },
            function(data){$('#testdiv').html('');$('#testdiv').html(data);
            });
        }
        });      

       

        
    });    


</script>