@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                New Trainer Booking
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary" href="{{ route('admin.trainerbookingcafes.index') }}"> Back</a>
            </div>
        </div>
    </div>
    {!! Form::open(array('route' => 'trainerbookingcafes.store','method'=>'POST', 'enctype' => 'multipart/form-data',
    'name' => 'trainerbookingcafe')) !!}
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="order_id">User:</label>
                    {!! Form::select('users_id', $users, null, ['class' => 'form-control', 'id' => 'user']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="order_id">Booking Date:</label>
                    {!! Form::text('booking_date', null, array('placeholder' => 'Booking Date','class' =>
                    'form-control date', 'id' => 'booking_date', 'onchange' => 'updateTrainersList()')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div id="timerinputs_from" class="form-group timerinputs_from">
                        <label class="required" for="order_id">From Time:</label>
                        {!! Form::select('booking_start_time', $frm_slots, null, ['class' => 'form-control', 'id' =>
                        'booking_start_time', 'onchange' => 'updateTrainersList()']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div id="timerinputs_to" class="form-group timerinputs_to">
                        <label class="required">To Time:</label>
                        {!! Form::select('booking_end_time', $to_slots, null, ['class' => 'form-control', 'id' =>
                        'booking_end_time', 'onchange' => 'updateTrainersList()']) !!}
                    </div>
                </div>
            </div>                    
        </div>
        <div class="form-group">
            <div class="form-group" id="trainer_div" style="display: none;"></div>
        </div>
        <div class="form-group">
            <div class="form-group col-md-12" id="time_err_msg" style="display: none;">
            </div>
        </div>
        <div class="form-group">
            <label class="required">Booking amount:</label>
            {!! Form::text('booking_amount', null, array('placeholder' => 'Booking Amount','class' => 'form-control',
            'id' => 'booking_amount')) !!}
        </div>
        <div class="form-group">
            <label class="required">Payment Type:</label>
            {{ Form::radio('payment_type', '1' , true) }} Cash &nbsp;
            {{ Form::radio('payment_type', '2' , false) }} Online
            {{ Form::radio('payment_type', '3' , false) }} Card
            {{ Form::radio('payment_type', '4' , false) }} Offline
        </div>
        <div class="form-group">
            <label class="required">Transaction ID:</label>
            {!! Form::text('transaction_id', $transaction_id, array('placeholder' => 'Transaction ID','class' =>
            'form-control', 'id' => 'transaction_id', 'readonly' => true)) !!}
        </div>
        <div class="form-group">
            <label class="required">Payment Details:</label>
            {!! Form::textarea('payment_details', null, array('placeholder' => 'Payment Details','class' =>
            'form-control', 'id' => 'payment_details', 'cols' =>8, 'rows' => 3)) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection
@section('scripts')

<script type="text/javascript">
    function calculatePrice(){
        var price_per_day = $("#price_per_day").val();
        var total_number_of_days = $("#total_number_of_days").val();
        if(price_per_day && total_number_of_days){
            var total_cost = price_per_day * total_number_of_days;
            $("#total_cost").val(total_cost);
        }else{
            $("#total_cost").val('');
        }
    }

    $(document).ready(function(){       
        $('#booking_date').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'en',
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            },
            startDate: new Date(),
            autoClose:true,
            orientation: "bottom"
        });

        $('input:radio[name="is_deposit_amount"]').change(function() {
            if ($(this).val() == '1') {
                $("#deposit_div").show();
            } else {
                $("#deposit_div").hide();
            }
        });

        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        /* $("form[name='trainerbookingcafe']").validate({
          // Specify validation rules
          rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            mst_trainer_id:"required",
            users_id:"required",
            from_time : "required",
            to_time : "required",
            booking_date : "required",
            
          },
          // Specify validation error messages
          messages: {
            mst_trainer_id:"Please select trainer",
            users_id:"Please select user",
            from_time:"Please select from time",
            to_time:"Please select to time",
            booking_date:"Please select booking date",
            
          },
          // Make sure the form is submitted to the destination defined
          // in the "action" attribute of the form when valid
          submitHandler: function(form) {
            form.submit();
          }
        });*/
    }); 

    function updateTrainersList() {
          checkDates();
          if ($('#booking_date').val() == '' || $('#booking_start_time').val() == '' || $('#booking_end_time').val() == ''){
            $("#trainer_div").html('');
            $("#mst_trainer_id").val('');
            return false;
          } else {
            $("#trainer_div").hide();
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url:"/getTrainersAsPerTime",
              method:"post",
              type:"json",
              data:{'booking_date' : $("#booking_date").val(),'booking_start_time':$('#booking_start_time').val(), 'booking_end_time':$('#booking_end_time').val()},
              success:function (response) {
                    var responseData = $.parseJSON(response);
                    $("#trainer_div").show();
                    $("#trainer_div").html(responseData.html);          
              }
            });
          }

        }


        function checkDates() {

          if (($('#booking_start_time').val() == '') || ($('#booking_end_time').val() == '')){
            $("#trainer_div").html('');
            $("#mst_trainer_id").val('');
            return false;
          } else {
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
                      $("#trainer_div").html('');
                      $("#mst_trainer_id").val('');
                      $('#booking_end_time').val('');
                     // $("#time_err_msg").html();
                      alert('To time should be greater then from time.');
                      return false;
                    }
             
              }
            });
          }         

        }

</script>
@endsection