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
                <h2 class="main_title  heading"><span>Book a Slot</span></h2>
              </div>
            </div>
          </div>
       
            <!-- Main content -->
          <section class="content">
            <div class="box box-default">
              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif

              <div class="box-body">

                {!! Form::open(array('route' => 'bookslotpost','method'=>'POST', 'enctype' => 'multipart/form-data', 'name' => 'trainerbookingcafe', 'class' => ' full')) !!}

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
                       <div id="timerinputs_from" class="form-group col-md-4 timerinputs_from">
                        <strong>From Time:</strong>
                          {!! Form::select('booking_start_time',  $frm_slots, null, ['class' => 'form-control', 'id' => 'booking_start_time', 'onchange' => 'updateTrainersList()']) !!}
                       </div>

                       <div id="timerinputs_to" class="form-group col-md-4 timerinputs_to">
                         <strong>To Time:</strong>
                          {!! Form::select('booking_end_time', $to_slots, null, ['class' => 'form-control', 'id' => 'booking_end_time', 'onchange' => 'updateTrainersList()']) !!}                     
                         
                       </div> 
                       
                     </div>
                  </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </section>
       
        </div>
      </section>
      <!-- CONTAINER END --> 
      
@include('frontend.layouts.footer')

<script type="text/javascript">
    
    $(document).ready(function(){  

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