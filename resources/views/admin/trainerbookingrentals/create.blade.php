@extends('layouts.admin')
@section('content')
        
        <div class="card">
                <div class="card-header">
                    Rent Trainer
                </div>
            {!! Form::open(array('route' => 'storeRentalBookings','method'=>'POST', 'enctype' => 'multipart/form-data', 'name' => 'trainerbookingrental')) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="users_id">User:</label>
                            {!! Form::select('users_id', $users, null, ['class' => 'form-control select2', 'id' => 'user']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="price_per_day">Price (Per Day):</label>
                            {!! Form::text('price_per_day', null, array('autocomplete' => 'off','placeholder' => 'Price (Per Day)','onblur'=>'return calculatePrice()','class' => 'form-control', 'id' => 'price_per_day')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="from_date">From Date:</label>
                            {!! Form::text('from_date', null, array('autocomplete' => 'off','placeholder' => 'From Date','class' => 'form-control datepicker', 'id' => 'from_date')) !!}&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="to_date">To Date</label>
                            {!! Form::text('to_date', null, array('autocomplete' => 'off','placeholder' => 'To Date','class' => 'form-control datepicker', 'id' => 'to_date')) !!}&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="total_number_of_days">No of Days:</label>
                            {!! Form::text('total_number_of_days', null, array('placeholder' => 'Total Number Of Days','class' => 'form-control', 'id' => 'total_number_of_days', 'readonly' => true)) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="total_cost">Total Cost:</label>
                            {!! Form::text('total_cost', null, array('placeholder' => 'Total Cost','class' => 'form-control', 'id' => 'total_cost', 'readonly'=>true)) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="booking_amount">Deposit Amount:</label>
                            {!! Form::text('booking_amount', null, array('placeholder' => 'Deposit Amount','class' => 'form-control', 'id' => 'booking_amount')) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="trainer_div" style="display: none;">
                      
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="payment_type">Payment:</label>
                            {{ Form::radio('payment_type', '1' , true) }} Cash &nbsp;
                            {{ Form::radio('payment_type', '2' , false) }} Online
                            {{ Form::radio('payment_type', '3' , false) }} Card
                            {{ Form::radio('payment_type', '4' , false) }} Offline
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="transaction_id" style="display: none;">
                            <label class="required" for="trainer_description">Transaction ID:</label>
                            {!! Form::text('transaction_id', $transaction_id, array('placeholder' => 'Transaction ID','class' => 'form-control', 'id' => 'transaction_id', 'readonly' => true)) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="payment_details">Payment Details:</label>
                            {!! Form::textarea('payment_details', null, array('placeholder' => 'Payment Details','class' => 'form-control', 'id' => 'payment_details', 'cols' =>8, 'rows' => 3)) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
@endsection
@section('scripts')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<script type="text/javascript">
function calculatePrice() {
    var price_per_day = $("#price_per_day").val();
    var total_number_of_days = $("#total_number_of_days").val();
    if (price_per_day && total_number_of_days) {
        var total_cost = price_per_day * total_number_of_days;
        $("#total_cost").val(total_cost);
    } else {
        $("#total_cost").val('');
    }
}

$(document).ready(function() {

    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
   /*  $("form[name='trainerpackagerental']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            mst_trainer_id: "required",
            users_id: "required",
            price_per_day: "required",
            total_number_of_days: "required",
            terms_n_conditions: "required"

        },
        // Specify validation error messages
        messages: {
            mst_trainer_id: "Please select trainer",
            users_id: "Please select user",
            price_per_day: "Please enter package price per day",
            total_number_of_days: "Please enter package total number of days",
            terms_n_conditions: "Please enter terms and conditions",

        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    }); */


    var dateFormat = "mm/dd/yy",
        from_date = $("#from_date").datepicker({
            startDate: new Date(),
            beforeShow: function(){    
            $(".ui-datepicker").css('font-size', 12) 
        },
            changeMonth: true,
            numberOfMonths: 1
        }).on("change", function() {
            to_date.datepicker("option", "minDate", getDate(this));
            calculateDays();
            getTrainersList();
        }),
        to_date = $("#to_date").datepicker({
            startDate: new Date(),
            changeMonth: true,
            numberOfMonths: 1
        }).on("change", function() {
            from_date.datepicker("option", "maxDate", getDate(this));
            calculateDays();
            getTrainersList();
        });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }

});


function calculateDays() {
    $("#total_number_of_days").val('');
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if (from_date != '' && to_date != '') {
        var startDay = new Date(from_date);
        var endDay = new Date(to_date);

        var millisBetween = startDay.getTime() - endDay.getTime();
        var days = millisBetween / (1000 * 3600 * 24);

        var day_diff = Math.round(Math.abs(days));

        if (day_diff == 0) {
            day_diff = 1;
        } else {
            day_diff += 1;
        }

        $("#total_number_of_days").val(day_diff);

        calculatePrice();
    }
}

function getTrainersList() {

    if ($('#from_date').val() == '' || $('#to_date').val() == '') {
        $("#trainer_div").html('');
        $("#mst_trainer_id").val('');
        return false;
    } else {
        $("#trainer_div").hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/getTrainersAsPerDate",
            method: "post",
            type: "json",
            data: {
                'from_date': $("#from_date").val(),
                'to_date': $('#to_date').val()
            },
            success: function(response) {
                var responseData = $.parseJSON(response);
                $("#trainer_div").show();
                $("#trainer_div").html(responseData.html);
            }
        });
    }

}
</script>
@endsection