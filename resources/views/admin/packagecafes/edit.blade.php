@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                Edit Trainer Package
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href="{{ route('admin.packagecafes.index') }}"> Back</a>
            </div>
        </div>
    </div>
    {!! Form::model($packagecafe, ['method' => 'PATCH','route' => ['packagecafes.update', $packagecafe->id]]) !!}
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="package_name">Package Name:</label>
                    {!! Form::text('package_name', null, array('placeholder' => 'Package Name','class' =>
                    'form-control', 'id' => 'package_name')) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="validity">Validity:</label>
                    {!! Form::number('validity', null, array('placeholder' => 'Validity','class' => 'form-control', 'id'
                    => 'validity')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="price_per_hour">Price (Per Hour):</label>
                    {!! Form::text('price_per_hour', null, array('placeholder' => 'Price (Per Hour)','onkeyup'=>'calculatePrice()','class' => 'form-control', 'id' => 'price_per_hour')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="total_hours">Total Hours:</label>
                    {!! Form::text('total_hours', $calc_total_hours, array('placeholder' => 'Total
                    Hours','onkeyup'=>'calculatePrice()','class' => 'form-control', 'id' => 'total_hours')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="total_price">Total Price:</label>
                    {!! Form::text('total_price', null, array('placeholder' => 'Total Price','class' => 'form-control',
                    'id' => 'total_price', 'readonly'=>true)) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="terms_n_conditions">Terms & Conditions:</label>
                    {!! Form::textarea('terms_n_conditions', null, array('placeholder' => 'Terms & Conditions','class'
                    => 'form-control', 'id' => 'terms_n_conditions')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="package_tax">GST:</label>
                    {!! Form::select('package_tax', array(''=>'Select Tax','10' => '10%', '12' => '12%', '18'=>'18%'),
                    null, ['class' => 'form-control', 'id' => 'package_tax']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="required" for="is_cycle_included">Is Cycle included?:</label>
            {{ Form::radio('is_cycle_included', '1' , true) }} Yes &nbsp;
            {{ Form::radio('is_cycle_included', '0' , false) }} No
        </div>
        <div class="form-group">
            <label class="required" for="is_aadhar_verification_required">Aadhar Verification required:</label>
            {{ Form::radio('is_aadhar_verification_required', '1' , true) }} Yes &nbsp;
            {{ Form::radio('is_aadhar_verification_required', '0' , false) }} No
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection
@section('scripts')
@parent

<script type="text/javascript">
function calculatePrice() {
    var price_per_hour = $("#price_per_hour").val();
    var total_hours = $("#total_hours").val();
    if (price_per_hour && total_hours) {
        var total_price = price_per_hour * total_hours;
        $("#total_price").val(total_price);
    } else {
        $("#total_price").val('');
    }
}

$(document).ready(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='trainerpackagecafe']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            package_name: "required",
            mst_trainer_id: "required",
            validity: "required",
            price_per_hour: "required",
            total_hours: "required",
            package_tax: "required",
            terms_n_conditions: "required"

        },
        // Specify validation error messages
        messages: {
            package_name: "Please enter package name",
            validity: "Please select package validity",
            mst_trainer_id: "Please select trainer",
            price_per_hour: "Please enter package price per hour",
            total_hours: "Please enter package total hours",
            package_tax: "Please select package tax",
            terms_n_conditions: "Please enter terms and conditions",

        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection