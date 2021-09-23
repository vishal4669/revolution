@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.trainerbookingrentals.create') }}">
            Rent a Trainer
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trainer Booking Rental</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>User:</strong>
                            {!! Form::select('users_id', $users, null, ['class' => 'form-control', 'id' =>
                            'users_id']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Trainer:</strong>
                            {!! Form::select('mst_trainer_id', $trainers, null, ['class' => 'form-control',
                            'id' => 'mst_trainer_id']) !!}

                        </div>
                    </div>
                </div>


                <table id="bookings" data-order='[[ 0, "desc" ]]' class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Trainer</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Price Per Day</th>
                            <th>Total Days</th>
                            <th>Total Price</th>
                            <th>Remarks</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="modal fade" id="cancelModal" style="opacity: 10; padding: 5%;" tabindex="-1" role="dialog"
    aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('method'=>'POST', 'name' => 'cancelRentalBookingsfrm', 'id' =>
            'cancelRentalBookingsfrm', 'class' => ' full')) !!}

            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="cancel_booking_id" id="cancel_booking_id">

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <strong class="col-md-12">Remarks:</strong>
                            {!! Form::textarea('remarks',null,[ 'maxlength'=>'200', 'class'=>'form-control summernote',
                            'id' => 'remarks', 'rows' => 8, 'cols' => 50]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="submitCancelRentalBookingsForm()" class="btn btn-primary">Submit</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="startBookingModal" style="opacity: 10; padding: 5%; " tabindex="-1" role="dialog"
    aria-labelledby="startBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('route' => 'bookings.startRentalBooking.store','method'=>'POST', 'name' =>
            'trainerbookingrental', 'id' => 'startForm', 'class' => ' full')) !!}

            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Start Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="main_booking_id" id="main_booking_id">


                {!! Form::hidden('booking_users_id', null, array('id' => 'booking_users_id')) !!}

                <div class="col-md-12">
                    <div class="form-group row container-fluid">
                        <strong class="col-md-12">Total Number Of Days:</strong>
                        <div class="form-group col-md-4">
                            {!! Form::text('from_date', null, array('placeholder' => 'From Date','class' =>
                            'form-control ', 'id' => 'from_date')) !!}
                        </div>
                        <div class="form-group col-md-4">

                            {!! Form::text('to_date', null, array('placeholder' => 'To Date','class' => 'form-control',
                            'id' => 'to_date')) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::text('total_number_of_days', null, array('placeholder' => 'Total Number Of
                            Days','class' => 'form-control', 'id' => 'total_number_of_days', 'readonly' => true)) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row container-fluid">
                        <div class="form-group col-md-6">
                            <strong>Booking Amount:</strong>
                            {!! Form::text('booking_amount', null, array('placeholder' => 'Booking Amount','class' =>
                            'form-control','onkeyup' => 'calculatePrice()', 'id' => 'booking_amount')) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <strong>Payment Status:</strong><br>
                            {{ Form::radio('payment_status', '2' , false, array('id'=>'payment_status_2')) }} Paid
                            &nbsp;
                            {{ Form::radio('payment_status', '1' , true, array('id'=>'payment_status_1')) }} Non-paid
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group row container-fluid">
                        <div class="form-group col-md-6">
                            <strong>Price (Per Day):</strong>
                            {!! Form::text('price_per_day', null, array('placeholder' => 'Price (Per
                            Day)','onblur'=>'return calculatePrice()','class' => 'form-control', 'id' =>
                            'price_per_day')) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <strong>Take Payment:</strong>
                            {!! Form::text('take_payment', null, array('placeholder' => 'Take Payment','class' =>
                            'form-control', 'onkeyup' => 'calculatePrice()', 'id' => 'take_payment')) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <strong>Final Amount:</strong>
                            {!! Form::text('total_cost', null, array('placeholder' => 'Total Cost','class' =>
                            'form-control', 'id' => 'total_cost')) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <strong>Remaining Amount:</strong>
                            {!! Form::text('remaining_amount', null, array('placeholder' => 'Remaining Amount','class'
                            => 'form-control', 'id' => 'remaining_amount', 'readonly' => true)) !!}
                        </div>

                    </div>
                </div>


                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group" id="trainer_div" style="display: none;">
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Payment Type:</strong>
                        {{ Form::radio('payment_type', '1' , true, array('id'=>'payment_type_1')) }} Cash &nbsp;
                        {{ Form::radio('payment_type', '2' , false, array('id'=>'payment_type_2')) }} Online
                        {{ Form::radio('payment_type', '3' , false, array('id'=>'payment_type_3')) }} Card
                        {{ Form::radio('payment_type', '4' , false, array('id'=>'payment_type_4')) }} Offline
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <strong>Transaction ID:</strong>
                            {!! Form::text('transaction_id', null, array('placeholder' => 'Transaction ID','class' =>
                            'form-control', 'id' => 'transaction_id', 'readonly' => true)) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <strong>Payment Details:</strong>
                            {!! Form::textarea('payment_details', null, array('placeholder' => 'Payment Details','class'
                            => 'form-control', 'id' => 'payment_details', 'cols' =>8, 'rows' => 3)) !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Start Booking</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="viewBookingModal" style="opacity: 10; padding: 5%; " tabindex="-1" role="dialog"
    aria-labelledby="viewBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('route' => 'bookings.viewRentalBooking.store','method'=>'POST', 'name' =>
            'trainerbookingrental_view', 'id' => 'viewForm', 'class' => ' full')) !!}

            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">View Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="view_main_booking_id" id="view_main_booking_id">
                <input type="hidden" name="booking_amount_payment_status" id="booking_amount_payment_status">
                <div class="row">
                    <div class="col-md-4">
                        <label>From Date:</label>
                        {!! Form::text('view_from_date', null, array('placeholder' => 'From Date','class' =>
                        'form-control ', 'id' => 'view_from_date', 'readonly' => true)) !!}
                    </div>
                    <div class="col-md-4">
                        <label>To Date:</label>
                        {!! Form::text('view_to_date', null, array('placeholder' => 'Completion Date','class' =>
                        'form-control', 'id' => 'view_to_date', 'onkeyup' => 'viewCalculatePrice()')) !!}
                    </div>
                    <div class="col-md-4">
                        <label>No. Of Days:</label>
                        {!! Form::text('view_total_number_of_days', null, array('placeholder' => 'Total Number
                        Of Days','class' => 'form-control', 'id' => 'view_total_number_of_days', 'readonly' =>
                        true)) !!}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Rent (Per Day)</th>
                                <th><span id="view_price_per_day"></span></th>
                            </tr>
                            <tr>
                                <th>Total Rent</th>
                                <th><label id="view_total_cost"></label></th>
                            </tr>
                            <tr>
                                <th>Deposit</th>
                                <th><span id="view_booking_amount"></span> (<label id="booking_amt_status"></label>)
                                </th>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Discount:</label>
                                {!! Form::text('discount', null, array('placeholder' => 'discount','class' =>
                                'form-control',
                                'id' => 'discount', 'onkeyup' => 'viewCalculatePrice()')) !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label>Remaining Amount:</label>
                                {!! Form::text('view_remaining_amount', null, array('placeholder' => 'Remaining
                                Amount','class'
                                => 'form-control', 'id' => 'view_remaining_amount')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Payment Type:</strong>
                        {{ Form::radio('view_payment_type', '1' , true, array('id'=>'payment_type_1')) }} Cash &nbsp;
                        {{ Form::radio('view_payment_type', '2' , false, array('id'=>'payment_type_2')) }} Online
                        {{ Form::radio('view_payment_type', '3' , false, array('id'=>'payment_type_3')) }} Card
                        {{ Form::radio('view_payment_type', '4' , false, array('id'=>'payment_type_4')) }} Offline
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <strong>Transaction ID:</strong>
                            {!! Form::text('transaction_id', $transaction_id, array('placeholder' => 'Transaction
                            ID','class' => 'form-control', 'id' => 'transaction_id', 'readonly' => true)) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <strong>Payment Details:</strong>
                            {!! Form::textarea('view_payment_details', null, array('placeholder' => 'Payment Details','class' => 'form-control', 'id' => 'view_payment_details', 'cols' =>8, 'rows' =>
                            3))
                            !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" onclick="return confirm('Are you sure  to complete booking?')"
                    class="btn btn-primary">Complete Booking</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
function calculatePrice() {debugger
    var price_per_day = $("#price_per_day").val();
    var total_number_of_days = $("#total_number_of_days").val();

    if (price_per_day && total_number_of_days) {
        var total_cost = price_per_day * total_number_of_days;

        var total_cost_new = total_cost - $('#take_payment').val();
        var total_cost_final = total_cost_new - $('#booking_amount').val();

        $("#total_cost").val(total_cost);
        $("#remaining_amount").val(total_cost_final);


    } else {
        $("#total_cost").val('');
        $("#remaining_amount").val('');
    }
}

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

function viewCalculateDays() {
    $("#view_total_number_of_days").val('');
    var view_from_date = $("#view_from_date").val();
    var view_to_date = $("#view_to_date").val();

    if (view_from_date != '' && view_to_date != '') {
        var viewstartDay = new Date(view_from_date);
        var viewendDay = new Date(view_to_date);

        var viewMillisBetween = viewstartDay.getTime() - viewendDay.getTime();
        var viewDays = viewMillisBetween / (1000 * 3600 * 24);

        var view_day_diff = Math.round(Math.abs(viewDays));

        if (view_day_diff == 0) {
            view_day_diff = 1;
        } else {
            view_day_diff += 1;
        }

        $("#view_total_number_of_days").val(view_day_diff);

        viewCalculatePrice();
    }
}

function viewCalculatePrice() {
    var view_price_per_day = parseInt($("#view_price_per_day").text());
    var view_total_number_of_days = $("#view_total_number_of_days").val();

    if (view_price_per_day && view_total_number_of_days) {
        var view_total_cost = view_price_per_day * view_total_number_of_days;

        var view_total_cost_new = view_total_cost - parseInt($('#view_take_payment').text());

        var payment_status = $("#booking_amount_payment_status").val();

        if (payment_status == 1) {
            var view_total_cost_final = view_total_cost_new - parseInt($('#view_booking_amount').text());
        } else {
            var view_total_cost_final = view_total_cost_new;
        }


        var remain_cost_after_discount = view_total_cost_final - $('#discount').val();

        $("#view_total_cost").text(view_total_cost);
        $("#view_remaining_amount").val(remain_cost_after_discount);


    } else {
        $("#view_total_cost").text('');
        $("#view_remaining_amount").val('');
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


$(document).ready(function() {


    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    /* $("form[name='trainerpackagerental']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            mst_trainer_id: "required",
            users_id: "required",
            price_per_day: "required",
            total_number_of_days: "required"

        },
        // Specify validation error messages
        messages: {
            mst_trainer_id: "Please select trainer",
            users_id: "Please select user",
            price_per_day: "Please enter package price per day",
            total_number_of_days: "Please enter package total number of days"

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

    $("#view_to_date").datepicker({
        startDate: new Date(),
        changeMonth: true,
        numberOfMonths: 1
    }).on("change", function() {
        viewCalculateDays();
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // DataTable
    var table = $('#bookings').DataTable({
        processing: true,
        serverSide: true,
        "searching": false,
        ajax: {
            url: "{{route('admin.rentalbookings.getRentalBookings')}}",
            data: function(d) {
                d.users_id = $('#users_id').val(),
                    d.mst_trainer_id = $('#mst_trainer_id').val()
            }
        },
        columns: [{
                data: 'no'
            },
            {
                data: 'user'
            },
            {
                data: 'trainer'
            },
            {
                data: 'from_date'
            },
            {
                data: 'to_date'
            },
            {
                data: 'price_per_day'
            },
            {
                data: 'total_days'
            },
            {
                data: 'total_price'
            },
            {
                data: 'remarks'
            },
            {
                data: 'action'
            }
        ]
    });

    $('#users_id').change(function() {
        table.draw();
    });
    $('#mst_trainer_id').change(function() {
        table.draw();
    });


});

function cancelRentalBookings(booking_id) {
    $("#cancelModal").modal('show');
    $("#cancel_booking_id").val(booking_id);
}

function startBooking(booking_id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/getRentalBooking",
        method: "post",
        type: "json",
        data: {
            'booking_id': booking_id
        },
        success: function(response) {
            var responseData = $.parseJSON(response);
            $("#startBookingModal").modal('show');
            $("#main_booking_id").val(booking_id);
            $("#booking_date_span").html($("#booking_date_value_" + booking_id).val());


            var fromNewDate = new Date(responseData.booking_data.from_date);
            var yr = fromNewDate.getFullYear();
            var month = fromNewDate.getMonth() < 10 ? fromNewDate.getMonth() : fromNewDate.getMonth();
            var day = fromNewDate.getDate() < 10 ? fromNewDate.getDate() : fromNewDate.getDate();
            month = parseInt(month) + 1;
            fromNewDate = month + '/' + day + '/' + yr;

            var toNewDate = new Date(responseData.booking_data.to_date);
            var yr = toNewDate.getFullYear();
            var month = toNewDate.getMonth() < 10 ? toNewDate.getMonth() : toNewDate.getMonth();
            var day = toNewDate.getDate() < 10 ? toNewDate.getDate() : toNewDate.getDate();
            month = parseInt(month) + 1;
            toNewDate = month + '/' + day + '/' + yr;

            $("#from_date").val(fromNewDate);
            $("#to_date").val(toNewDate);

            $("#booking_amount").val(responseData.booking_data.booking_amount);

            $("#total_number_of_days").val(responseData.booking_data.total_number_of_days);
            $("#price_per_day").val(responseData.booking_data.price_per_day);
            //$("#total_cost").val(responseData.booking_data.total_cost);
            $("#take_payment").val(responseData.booking_data.take_payment);
            $("#transaction_id").val(responseData.booking_data.transaction_id);
            $("#booking_users_id").val(responseData.booking_data.users_id);

            if (responseData.booking_data.payment_type == '' || responseData.booking_data.payment_type ==
                null) {
                $("#payment_type_1").prop("checked", true);
            } else {
                $("#payment_type_" + responseData.booking_data.payment_type).prop("checked", true);
            }

            if (responseData.booking_data.payment_type == '' || responseData.booking_data.payment_type ==
                null) {
                $("#payment_status_1").prop("selected", true);
            } else {
                $("#payment_status_" + responseData.booking_data.payment_type).prop("selected", true);
            }




            getTrainersList();

            calculatePrice();
            console.log(responseData);

        }
    });

    $("#startBookingModal").modal('show');
    $("#main_booking_id").val(booking_id);
}

function viewBooking(booking_id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/getRentalBooking",
        method: "post",
        type: "json",
        data: {
            'booking_id': booking_id
        },
        success: function(response) {debugger
            var responseData = $.parseJSON(response);
            $("#viewBookingModal").modal('show');
            $("#main_booking_id").val(booking_id);
            $("#booking_date_span").html($("#booking_date_value_" + booking_id).val());


            var fromNewDate = new Date(responseData.booking_data.from_date);
            var yr = fromNewDate.getFullYear();
            var month = fromNewDate.getMonth() < 10 ? fromNewDate.getMonth() : fromNewDate.getMonth();
            var day = fromNewDate.getDate() < 10 ? fromNewDate.getDate() : fromNewDate.getDate();
            month = parseInt(month) + 1;
            fromNewDate = month + '/' + day + '/' + yr;

            var toNewDate = new Date(responseData.booking_data.to_date);
            var yr = toNewDate.getFullYear();
            var month = toNewDate.getMonth() < 10 ? toNewDate.getMonth() : toNewDate.getMonth();
            var day = toNewDate.getDate() < 10 ? toNewDate.getDate() : toNewDate.getDate();
            month = parseInt(month) + 1;
            toNewDate = month + '/' + day + '/' + yr;

            $("#view_from_date").val(fromNewDate);
            $("#view_to_date").val(toNewDate);

            $("#view_booking_amount").text(responseData.booking_data.booking_amount);
            $("#booking_amount_payment_status").val(responseData.booking_data.payment_status);

            if (responseData.booking_data.payment_status == 1) {
                $("#booking_amt_status").text("Paid");

            } else {
                $("#booking_amt_status").text("Non-Paid");
            }
            $("#view_price_per_day").text(responseData.booking_data.price_per_day);
            //$("#total_cost").val(responseData.booking_data.total_cost);
            $("#view_take_payment").text(responseData.booking_data.take_payment);
            $("#view_booking_users_id").val(responseData.booking_data.users_id);

            if (responseData.booking_data.payment_type == '' || responseData.booking_data.payment_type ==
                null) {
                $("#view_payment_type_1").prop("checked", true);
            } else {
                $("#view_payment_type_" + responseData.booking_data.payment_type).prop("checked", true);
            }

            viewCalculateDays();
            viewCalculatePrice();


        }
    });

    //$("#startBookingModal").modal('show');
    $("#view_main_booking_id").val(booking_id);
}
</script>

<script type="text/javascript">
// function to handle form submit
function submitCancelRentalBookingsForm() {
    $.ajax({
        type: "POST",
        url: "{{url('/rentalbookings/cancelRentalBookings')}}",
        cache: false,
        data: $('form#cancelRentalBookingsfrm').serialize(),
        success: function(response) {
            $("#cancelModal").modal('hide');
            $('#bookings').DataTable().draw();
            console.log(response);
        },
        error: function() {
            $("#error_message").html();
        }
    });
}
</script>
@endsection