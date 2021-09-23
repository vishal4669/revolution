@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.trainerbookingcafes.create') }}">
                Book Trainer
            </a>
        </div>
    </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Trainer Booking Cafe</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <strong>User:</strong>
                          {!! Form::select('users_id', $users, null, ['class' => 'form-control', 'id' => 'users_id']) !!}
                      </div>                      
                  </div>

                  <div class="col-md-4">
                      <div class="form-group">
                          <strong>Trainer:</strong>
                          {!! Form::select('mst_trainer_id', $trainers, null, ['class' => 'form-control', 'id' => 'mst_trainer_id']) !!}

                      </div>                  
                  </div>

                  <div class="col-md-4">
                      <div class="form-group">
                          <strong>Booking Date:</strong>
                          {!! Form::text('booking_date', null, array('placeholder' => 'Booking Date','class' => 'form-control date', 'id' => 'booking_date')) !!}

                      </div>                  
                  </div>
                </div>
                <table id="bookings" data-order='[[ 0, "desc" ]]' class="table table-bordered table-striped table-hover">
                  <thead>                
                        <tr>
                           <th>No</th>
                           <th>User Name</th>
                           <th>Trainer</th>
                           <th>Date & Time</th>
                           <th>Amount</th>
                           <th>Status</th>
                           <th>Performance</th>
                           <th>Timer</th>
                           <th>Remarks</th>
                           <th>Action</th>
                        </tr>
                  </thead>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

    
    <div class="modal fade" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cancelModalLabel">Summary</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body my-1">
              <table class="table table-bordered table-striped table-hover">
                <tr>
                  <th>User Name</th>
                  <th><span id="user"></span></th>
                </tr>
                <tr>
                  <th>Trainer</th>
                  <th><span id="trainer"></span></th>
                </tr>
                <tr>
                  <th>Date</th>
                  <th><span id="date"></span>
                </tr>
                <tr>
                  <th>Date & Time</th>
                  <th><span id="start_time"></span><br><b>To</b>
                  <span id="end_time"></span></th>
                </tr> 
                <tr>
                  <th>Amount</th>
                  <th><span id="amount"></span></th>
                </tr>
                <tr>
                  <th>Status</th>
                  <th><span id="status">Completed</span></th>
                </tr>
                <tr>
                  <th>Performance</th>
                  <th><span id="performance"></span></th>
                </tr>
              </table>
          </div>
          <div class="modal-footer">
            
          </div>
    
 
        </div>
      </div>
    </div>


    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          {!! Form::open(array('method'=>'POST', 'name' => 'trainerbookingcafe', 'id' => 'confirmForm', 'class' => ' full')) !!}

          <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">Confirm Booking</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="main_booking_id" id="main_booking_id">

                <div class="row">             
                    <div class="col-md-12">
                      <div class="form-group">
                        <strong class="col-md-12">Booking Date:</strong>
                        <span id="booking_date_span"></span>                        
                    </div>
                  </div>
                </div>

                <div class="row">             
                    <div class="col-md-6">
                      <div class="form-group" id="trainer_div" style="display: none;">
                        <strong class="col-md-12">Available Trainer:</strong>
                        
                        
                    </div>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" onclick="submitForm()" class="btn btn-primary">Confirm Booking</button>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>


    <div class="modal fade" id="perModal" tabindex="-1" role="dialog" aria-labelledby="perModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          {!! Form::open(array('method'=>'POST', 'name' => 'booking_perforamance', 'id' => 'performanceForm', 'class' => ' full')) !!}

          <div class="modal-header">
            <h5 class="modal-title" id="perModalLabel">Booking Performance</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="per_booking_id" id="per_booking_id">

                <div class="row">             
                    <div class="col-md-10">
                      <div class="form-group">
                        <strong class="col-md-12">Performance:</strong>
                         {!! Form::textarea('performance',null,[ 'maxlength'=>'200', 'class'=>'form-control summernote', 'id' => 'performance', 'rows' => 8, 'cols' => 50]) !!}                        
                    </div>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" onclick="submitPerformanceForm()" class="btn btn-primary">Submit</button>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <div class="modal fade" id="cancelModal" style="opacity: 10; padding: 5%;" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          {!! Form::open(array('method'=>'POST', 'name' => 'cancelBookingcafesfrm', 'id' => 'cancelBookingcafesfrm', 'class' => ' full')) !!}
    
          <div class="modal-header">
            <h5 class="modal-title" id="cancelModalLabel">Cancel Booking Cafes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="cancel_bookingcafes_id" id="cancel_bookingcafes_id">
    
                <div class="row">             
                    <div class="col-md-10">
                      <div class="form-group">
                        <strong class="col-md-12">Remarks:</strong>
                         {!! Form::textarea('remarks',null,[ 'maxlength'=>'200', 'class'=>'form-control summernote', 'id' => 'remarks', 'rows' => 8, 'cols' => 50]) !!}                        
                    </div>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" onclick="submitCancelBookingcafesForm()" class="btn btn-primary">Submit</button>
          </div>
    
          {!! Form::close() !!}
        </div>
      </div>
    </div>

    @endsection
    @section('scripts')
    <script src="https://momentjs.com/downloads/moment.js"></script>
  <script type="text/javascript">
   
    $(document).ready(function(){

     //$('.timer').startTimer();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // DataTable
      var table = $('#bookings').DataTable({
        columnDefs: [{
        orderable: false,
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    pageLength: 10,
        dom: 'lfrtip',
         processing: true,
         serverSide: true,
         "searching": false,
          "autoWidth": false,
          "responsive": true,
         ajax: {
            url : "{{route('admin.bookings.getBookings')}}",
            data: function (d) {
                d.users_id = $('#users_id').val(),
                d.mst_trainer_id = $('#mst_trainer_id').val(),
                d.booking_date = $('#booking_date').val()
            }
         },
         columns: [
            { data: 'no' },
            { data: 'user' },
            { data: 'trainer' },
            { data: 'datetime' },
            { data: 'booking_amount' },
            { data: 'status' },
            { data: 'performance' },
            { data: 'timer' },
            { data: 'remarks' },
            { data: 'action' }
         ],
      });

      $('#users_id').change(function(){
          table.draw();
      });
      $('#mst_trainer_id').change(function(){
          table.draw();
      });
      $('#booking_date').change(function(){
          table.draw();
      });

    });



    function confirmBooking(booking_id) {
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/getTrainersAsPerTime",
        method:"post",
        type:"json",
        data:{'booking_id' : booking_id},
        success:function (response) {
              var responseData = $.parseJSON(response);
              $("#trainer_div").show();
              $("#trainer_div").html(responseData.html);  

              $("#bookingModal").modal('show');
              $("#main_booking_id").val(booking_id);
              $("#booking_date_span").html($("#booking_date_value_"+booking_id).val());   
        }
      });

      $("#bookingModal").modal('show');
      $("#main_booking_id").val(booking_id);
      $("#booking_date_span").html($("#booking_date_value_"+booking_id).val());
    }

    function addPerformanceForBooking(booking_id) {
      $("#perModal").modal('show');
      $("#per_booking_id").val(booking_id);
    }

    function completeBooking(booking_id) {
        $.ajax({
            url:"{{url('/bookings/completebooking')}}",
            method:"GET",
            type:"json",
            data:{'id':booking_id},
            success:function (res) {                
               $('#bookings').DataTable().draw(false);     
            }
        });
    }

    function startTimer(booking_id) {
        $.ajax({
            url:"{{url('/bookings/starttimer')}}",
            method:"GET",
            type:"json",
            data:{'id':booking_id},
            success:function (res) {                
               $('#bookings').DataTable().draw(false);     
            }
        });
    }
    
    function cancelBookingcafes(booking_id) {
      $("#cancelModal").modal('show');
      $("#cancel_bookingcafes_id").val(booking_id);
    }
    function summary(booking_id) {
      $.ajax({
            url:"{{url('/bookings/summary')}}",
            method:"POST",
            type:"json",
            data:{'id':booking_id},
            success:function (res) {     
              console.log(res[0].booking_amount);           
              // format datetime
               var date = moment(res[0].booking_start_time, 'YYYY/MM/DD HH:mm:ss').format('DD-MMMM-YYYY');
               var start_time = moment(res[0].booking_start_time, 'YYYY/MM/DD HH:mm:ss').format('HH:mm:ss A');
               var end_time = moment(res[0].booking_end_time, 'HH:mm:ss').format('HH:mm:ss A');
              // format datetime
              //remove htmltag
               var regex = /(&nbsp;|<([^>]+)>)/ig;
               var txt = res[0].performance;
               var performace = txt.replace(regex, "");
              //remove htmltag
               $("#summaryModal").modal('show');
               $("#id").text(res[0].id);
               $("#user").text(res[0].name);
               $("#trainer").text(res[0].trainer_name);
               $("#date").text(date);
               $("#start_time").text(start_time);
               $("#end_time").text(end_time);
               $("#amount").text(res[0].booking_amount);
               $("#performance").text(performace);
                  
            }
        });
    }
    </script>
    <script type="text/javascript">
     
      // function to handle form submit
      function submitForm(){

        console.log($('form#confirmForm').serialize());

         $.ajax({
          type: "POST",
          url: "{{url('/bookings/confirmbooking')}}",
          cache:false,
          data: $('form#confirmForm').serialize(),
          success: function(response){ 
            var res = $.parseJSON(response);

            if(res.status==0){
              alert(res.message);
              $("#bookingModal").modal('hide');
            } else{
              $("#bookingModal").modal('hide');
              $('#bookings').DataTable().draw(false); 
            }
          
              
              
          },
          error: function(){
            $("#error_message").html();
          }
        });
      }

      // function to handle form submit
      function submitPerformanceForm(){
         $.ajax({
          type: "POST",
          url: "{{url('/bookings/addperformance')}}",
          cache:false,
          data: $('form#performanceForm').serialize(),
          success: function(response){                  
              $("#perModal").modal('hide');
              $('#bookings').DataTable().draw(); 
          },
          error: function(){
            $("#error_message").html();
          }
        });
      }

      function submitCancelBookingcafesForm(){
           $.ajax({
            type: "POST",
            url: "{{url('/bookings/cancelbookingcafes')}}",
            cache:false,
            data: $('form#cancelBookingcafesfrm').serialize(),
            success: function(response){                  
                $("#cancelModal").modal('hide');
                $('#bookings').DataTable().draw();
                console.log(response);
            },
            error: function(){
              $("#error_message").html();
            }
          });
        }

    </script>
     @endsection