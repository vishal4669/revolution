@include('frontend.layouts.header') 
      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Account</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="#">Home</a>/</li>
                <li><span>Account</span></li>
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
            <div class="col-lg-3">
              <div class="account-sidebar account-tab mb-sm-30">
                <div class="dark-bg tab-title-bg">
                  <div class="heading-part">
                    <div class="sub-title"><span></span> My Account</div>
                  </div>
                </div>
                <div class="account-tab-inner">
                  <ul class="account-tab-stap">
                    <li id="step1" class="active"> <a href="javascript:void(0)">Dashboard<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step2"> <a href="javascript:void(0)">Packages<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step3"> <a href="javascript:void(0)">Book A Trainer (Cafe)<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step4"> <a href="javascript:void(0)">Rent Trainer<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step5"> <a href="javascript:void(0)">Rent Cycle<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step6"> <a href="javascript:void(0)">Bookings<i class="fa fa-angle-right"></i> </a> </li>
                  
                    
                    <!--<li id="step4"> <a href="javascript:void(0)">Change Password<i class="fa fa-angle-right"></i> </a> </li> -->
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div id="data-step1" class="account-content" data-temp="tabdata" style="display:none">
                <div class="row">
                  <div class="col-12">
                    <div class="heading-part heading-bg mb-30">
                      <h2 class="heading m-0">Account Dashboard</h2>
                    </div>
                  </div>
                </div>
                <div class="mb-30">
                  <div class="row">
                    <div class="col-12">

                      @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                          <p>{{ $message }}</p>
                        </div>
                        @endif
                      
                      <div class="heading-part">
                        <h3 class="sub-heading">Hello, Set Name Here</h3>
                      </div>
                      <p>Remaining Hours : {{$wallet_hrs}}</p>
                    </div>
                  </div>
                </div>
                
              </div>
              
              <div id="data-step2" class="account-content" data-temp="tabdata" style="display:none">
                <div id="form-print" class="admission-form-wrapper">
                  <div class="row">
                    <div class="col-12">
                      <div class="heading-part heading-bg mb-30">
                        <h2 class="heading m-0">My Packages</h2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Validity</th>
                                <th>Expiry Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $count = 1;
                              @endphp
                              @foreach($userPackages as $package)
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$package->package_name}}</td>
                                  <td>{{$package->total_price}}</td>
                                  <td>{{$package->validity_total}}</td>
                                  <td>{{$package->expired_latest}}</td>                     
                                </tr> 
                                @php
                                  $count++;
                                @endphp 
                              @endforeach                            
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                
              </div>

              <div id="data-step3" class="account-content" data-temp="tabdata" style="display:none">
                <div class="row">
                  <div class="col-12">
                    <div class="heading-part heading-bg mb-30">
                      <h2 class="heading m-0">Book A Slot</h2>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                            <p>{{ $message }}</p>
                          </div>
                          @endif

                         {!! Form::open(array('route' => 'frontend.book-slot','method'=>'POST', 'enctype' => 'multipart/form-data', 'name' => 'trainerbookingcafe', 'class' => ' full')) !!}

                            <div class="row">
                                

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <strong class="col-md-12">Date:</strong>
                                    {!! Form::text('booking_date', null, array('placeholder' => 'Booking Date','class' => 'form-control', 'id' => 'booking_date')) !!}&nbsp;&nbsp;
                                    
                                </div>
                              </div>

                                
                              <div class="col-md-12">
                                
                                 <div class="row">

                                    <span id="calendarData" style="display: none;"></span>
                                  
                                     <!--<h4>Please select trainer and date from above calender to view available slots</h4> -->
                                      <!--<h4>Please select trainer and date from above calender to view available slots</h4> -->
                                   <div id="timerinputs_from" class="form-group col-md-6 timerinputs_from">
                                    <strong>From Time:</strong>
                                      {!! Form::select('booking_start_time',  $frm_slots, null, ['class' => 'form-control', 'id' => 'booking_start_time', 'onchange' => 'updateTrainersList()']) !!}
                                   </div>

                                   <div id="timerinputs_to" class="form-group col-md-6 timerinputs_to">
                                     <strong>To Time:</strong>
                                      {!! Form::select('booking_end_time', $to_slots, null, ['class' => 'form-control', 'id' => 'booking_end_time', 'onchange' => 'updateTrainersList()']) !!}                     
                                     
                                   </div> 
                                   
                                 </div>
                              </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                            {!! Form::close() !!}  


                    </div>
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
        var dateFormat = "mm/dd/yy",
        from_date = $( "#from_date" ).datepicker({
                  startDate: new Date(),
                  changeMonth: true,
                  numberOfMonths: 1
                }).on( "change", function() {
                  to_date.datepicker( "option", "minDate", getDate( this ) );
                  calculateDays();
                }),
        to_date = $( "#to_date" ).datepicker({
                startDate: new Date(),
                changeMonth: true,
                numberOfMonths: 1
              }).on( "change", function() {
                from_date.datepicker( "option", "maxDate", getDate( this ) );
                calculateDays();
              });
         
        function getDate( element ) {
          var date;

          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }         
          return date;
        }


        $('#booking_date').datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date(),
            autoClose:true,
            orientation: "bottom"
        });     

       

        // Initialize form validation on the registration form.
         
          $("form[name='trainerbookingcafe']").validate({
            // Specify validation rules
            rules: {
              booking_date:"required",
              booking_start_time:"required",
              booking_end_time:"required"
              
            },
            // Specify validation error messages
            messages: {
              booking_start_time:"Please select from time",
              booking_end_time:"Please select to time",
              booking_date:"Please select booking date"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
              form.submit();
            }
          });

          $("form[name='rentalbooking']").validate({
            // Specify validation rules
            rules: {
              booking_type:"required",
              from_date:"required",
              to_date:"required",
              payment_type : "required",
              payment_details : 'required'
              
            },
            // Specify validation error messages
            messages: {
              booking_type:"Please select booking type",
              from_date:"Please select from date",
              to_date:"Please select to date",
              payment_type:"Please select payment type",
              payment_details:"Please enter payment details",
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
              form.submit();
            }
          });

        
    });    

    function checkDates() {

          if (($('#booking_start_time').val() == '') || ($('#booking_end_time').val() == '')) return;

          $.ajax({
            headers: {
              
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/checktime",
            method:"post",
            type:"json",
            data:{'from_time':$('#booking_start_time').val(), 'to_time':$('#booking_end_time').val()},
            success:function (response) {
                  var responseData = $.parseJSON(response);
                  if(responseData.status==0){
                    $('#to_time').val('');
                    alert('To time should be greater then from time.');
                    return false;
                  }
           
            }
          });

        }

        function calculatePrice(){
            var price_per_day = '100';
            var total_number_of_days = $("#total_number_of_days").val();
            if(price_per_day && total_number_of_days){
                var total_cost = price_per_day * total_number_of_days;
                $("#total_cost").val(total_cost);
            }else{
                $("#total_cost").val('');
            }
        }

        function calculateDays(){
            $("#total_number_of_days").val('');
              var from_date = $("#from_date").val();
              var to_date = $("#to_date").val();

              if(from_date!='' && to_date!=''){

                   var startDay = new Date(from_date);
                    var endDay = new Date(to_date);
                   
                    var millisBetween = startDay.getTime() - endDay.getTime();
                    var days = millisBetween / (1000 * 3600 * 24);

                    var day_diff = Math.round(Math.abs(days));

                    if(day_diff==0){
                      day_diff = 1;
                    } else {
                      day_diff += 1;
                    }


                    $("#total_number_of_days").val(day_diff);

                    calculatePrice();
              }

          }


</script>