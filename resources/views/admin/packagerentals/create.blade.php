@include('layouts2.header')
@include('layouts2.navigation')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0">Create New Trainer Package Rental</h1>
          </div><!-- /.col -->
          <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.admin.packagerentals.index') }}"> Back</a>
        </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
               @endforeach
            </ul>
          </div>
        @endif

        <div class="box-body">

          {!! Form::open(array('route' => 'packagerentals.store','method'=>'POST', 'enctype' => 'multipart/form-data', 'name' => 'trainerpackagerental')) !!}

          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <strong>User:</strong>
                      {!! Form::select('users_id', $users, null, ['class' => 'form-control', 'id' => 'user']) !!}

                  </div>
                  
                  <div class="form-group">
                      <strong>Price (Per Day):</strong>
                      {!! Form::text('price_per_day', null, array('placeholder' => 'Price (Per Day)','onblur'=>'return calculatePrice()','class' => 'form-control', 'id' => 'price_per_day')) !!}
                  </div>

                  
                  <div class="form-group">
                      <strong>Total Cost:</strong>
                      {!! Form::text('total_price', null, array('placeholder' => 'Total Cost','class' => 'form-control', 'id' => 'total_price', 'readonly'=>true)) !!}
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                      <strong>Trainer:</strong>
                      {!! Form::select('mst_trainer_id', $trainers, null, ['class' => 'form-control', 'id' => 'trainer']) !!}

                  </div>

                  <div class="form-group">
                      <strong>Total Number Of Days:</strong>
                      {!! Form::text('total_number_of_days', null, array('placeholder' => 'Total Number Of Days','onblur'=>'return calculatePrice()','class' => 'form-control', 'id' => 'total_number_of_days')) !!}
                  </div>

                  
              </div>

 <!--
              <div class="col-md-12">
                  <div class="form-group">
                      <strong>Is Deposit Amount:</strong>
                      {{ Form::radio('is_deposit_amount', '1' , true) }} Yes &nbsp;
                      {{ Form::radio('is_deposit_amount', '0' , false) }} No
                  </div>
                  <div class="form-group col-md-6" id="deposit_div">
                      <strong>Deposit Amount:</strong>
                      {!! Form::text('deposited_amount', null, array('placeholder' => 'Deposit Amount','class' => 'form-control', 'id' => 'deposited_amount')) !!}
                  </div>                 
                 
              </div>
             
              <div class="col-md-12">
                <div class="form-group">
                    <strong>Payment Type:</strong>
                    {{ Form::radio('payment_type', '1' , true) }} Cash &nbsp;
                    {{ Form::radio('payment_type', '2' , false) }} Online &nbsp;
                    {{ Form::radio('payment_type', '3' , false) }} Card &nbsp;
                    {{ Form::radio('payment_type', '4' , false) }} Offline &nbsp;
                </div>
              </div>
            -->

            <div class="col-md-12">
                  <div class="form-group">
                      <strong>Aadhar Verification Required:</strong>
                      {{ Form::radio('is_aadhar_verification_required', '1' , true) }} Yes &nbsp;
                      {{ Form::radio('is_aadhar_verification_required', '0' , false) }} No
                  </div>
              </div>

              
              <div class="col-md-12">
                  <div class="form-group">
                      <strong>Terms & Conditions:</strong>
                      {!! Form::textarea('terms_n_conditions', null, array('placeholder' => 'Terms & Conditions','class' => 'form-control', 'id' => 'terms_n_conditions')) !!}
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

     <br>
</div>   

@include('layouts2.footer')

<script type="text/javascript">
    function calculatePrice(){
        var price_per_day = $("#price_per_day").val();
        var total_number_of_days = $("#total_number_of_days").val();
        if(price_per_day && total_number_of_days){
            var total_price = price_per_day * total_number_of_days;
            $("#total_price").val(total_price);
        }else{
            $("#total_price").val('');
        }
    }

    $(document).ready(function(){
        $('input:radio[name="is_deposit_amount"]').change(function() {
            if ($(this).val() == '1') {
                $("#deposit_div").show();
            } else {
                $("#deposit_div").hide();
            }
        });

        // Initialize form validation on the registration form.
          // It has the name attribute "registration"
          $("form[name='trainerpackagerental']").validate({
            // Specify validation rules
            rules: {
              // The key name on the left side is the name attribute
              // of an input field. Validation rules are defined
              // on the right side
              mst_trainer_id:"required",
              users_id:"required",
              price_per_day: "required",
              total_number_of_days: "required",
              terms_n_conditions: "required"
              
            },
            // Specify validation error messages
            messages: {
              mst_trainer_id:"Please select trainer",
              users_id:"Please select user",
              price_per_day: "Please enter package price per day",
              total_number_of_days: "Please enter package total number of days",
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

