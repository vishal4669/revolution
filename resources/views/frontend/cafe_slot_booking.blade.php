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
            <div class="col-12">
              <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-8 ">
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
                              <div class="col-lg-9">
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
            orientation: "bottom"
        });      

        // Initialize form validation on the registration form.
         
          $("form[name='trainerbookingcafe']").validate({
            // Specify validation rules
            rules: {
              booking_date:"required",
              from_time:"required",
              to_time:"required"
              
            },
            // Specify validation error messages
            messages: {
              from_time:"Please select from time",
              to_time:"Please select to time",
              booking_date:"Please select booking date"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
              form.submit();
            }
          });

        
    });    

    function checkDates() {

          if (($('#from_time').val() == '') || ($('#to_time').val() == '')) return;

          $.ajax({
            headers: {
              
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/checktime",
            method:"post",
            type:"json",
            data:{'from_time':$('#from_time').val(), 'to_time':$('#to_time').val()},
            success:function (response) {
                  var responseData = $.parseJSON(response);
                  if(responseData.status==0){
                    $('#to_time').val('');
                    alert('From time should be greater then to time.');
                    return false;
                  }
           
            }
          });

        }

</script>