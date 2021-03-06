@include('frontend.layouts.header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
          <div class="container">
              <section class="banner-detail center-xs">
                  <h1 class="banner-title">Checkout</h1>
                  <div class="bread-crumb right-side float-none-xs">
                      <ul>
                          <li><a href="{{ route('home') }}">Home</a>/</li>
                          <li><span>Checkout</span></li>
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
                  <div class="col-12">
                      <div class="checkout-step mb-40">
                          <ul>
                              <li class="active" id="step1">
                                  <a href="checkout.html">
                                      <div class="step">
                                          <div class="line"></div>
                                          <div class="circle">1</div>
                                      </div>
                                      <span>Details</span>
                                  </a>
                              </li>
                              <li id="step2">
                                  <a href="order-overview.html">
                                      <div class="step">
                                          <div class="line"></div>
                                          <div class="circle">2</div>
                                      </div>
                                      <span>Order Overview</span>
                                  </a>
                              </li>
                              <li id="step3">
                                  <a href="payment.html">
                                      <div class="step">
                                          <div class="line"></div>
                                          <div class="circle">3</div>
                                      </div>
                                      <span>Payment</span>
                                  </a>
                              </li>
                              <li id="step4">
                                  <a href="order-complete.html">
                                      <div class="step">
                                          <div class="line"></div>
                                          <div class="circle">4</div>
                                      </div>
                                      <span>Order Complete</span>
                                  </a>
                              </li>
                              <li>
                                  <div class="step">
                                      <div class="line"></div>
                                  </div>
                              </li>
                          </ul>
                          <hr>
                      </div>
                      <form id="main-form" method="post" action="{{ route('frontend.complete-checkout') }}" class="main-form full">
                        <input type="hidden" name="prod_id" id="prod_id" value="{{ $product->id }}">
                        <input type="hidden" name="prod_type" id="prod_type" value="{{ $prodType }}">
                        <input type="hidden" name="rent_per_day" id="rent_per_day" value="{{ $rents['rent_per_day'] }}">
                        <input type="hidden" name="rent_per_week" id="rent_per_week" value="{{ $rents['rent_per_week'] }}">
                        <input type="hidden" name="rent_per_fortnight" id="rent_per_fortnight" value="{{ $rents['rent_per_fortnight'] }}">
                        <input type="hidden" name="rent_per_month" id="rent_per_month" value="{{ $product->rent_month }}">
                        <div class="checkout-content" id="details">
                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-lg-8 col-md-8">
                                        <div class="row mb-20">
                                            <div class="col-12 mb-20">
                                                <div class="heading-part">
                                                    <h3 class="sub-heading">How long do you want to rent?</h3>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-box">
                                                    <select id="sel_days" name="sel_days" onchange="upd_days()" name="sel_days">
                                                        <option value='1'>1 Day</option>
                                                        <option value='7'>7 Days</option>
                                                        <option value='15'>15 Days</option>
                                                        <option value='30'>30 Days</option>
                                                        <option value='60'>60 Days</option>
                                                        <option value='90'>90 Days</option>
                                                    </select>
                                                    <span>Select Days</span>
                                                </div>
                                                <input type="hidden" name="total_days" id="total_days" value="{{ old('total_days', '') }}"/>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-box">
                                                <input class="date {{ $errors->has('from_date') ? 'is-invalid' : '' }}" type="text"
                                                  name="from_date" id="from_date" onchange="upd_days();" value="{{ old('from_date') ? old('from_date') : date('d-m-Y') }}">
                                                  <span>Start Date</span>
                                                </div>                                              
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-box">
                                                <input class="date {{ $errors->has('to_date') ? 'is-invalid' : '' }}" type="text"
                                                  name="to_date" id="to_date" readonly value="{{ old('to_date') ? old('to_date') : date('d-m-Y') }}">
                                                  <span>End Date</span>
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-20">
                                                <div class="heading-part">
                                                    <h3 class="sub-heading">Total Rent</h3>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-box">
                                                    <input type="text" id="price_per_day" name="price_per_day" value="{{ old('price_per_day', ($rents['rent_per_day'])) }}" readonly placeholder="Rent per day">
                                                    <span>Daily Rent</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-box">
                                                <input type="text" id="total_rent" name="total_rent" value="{{ old('total_rent', '') }}" readonly placeholder="Total Rent">
                                                <span>Total rent for Selected Dates</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-20 mt-xs-15">
                                                <a href="javascript:void(0)" onclick="loadOverview();" class="btn btn-color right-side">Next</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <!-- Overview Content -->

                        <div class="checkout-content" id="overview">
                          <div class="row">
                            <div class="col-12">
                              <div class="heading-part align-center">
                                <h2 class="heading">Rental Overview</h2>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xl-8 col-lg-7 mb-sm-30">
                              <div class="cart-item-table commun-table mb-30">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Product</th>
                                        <th>Product Detail</th>
                                        <th>Total (Rs)</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <a href="{{ route($prodType.'-detail', $product->id) }}">
                                            <div class="product-image">
                                              <img alt="Honour" src="{{ $product->photo[0]->url }}">
                                            </div>
                                          </a>
                                        </td>
                                        <td>
                                          <div class="product-title"> 
                                            <a href="{{ route($prodType.'-detail', $product->id) }}">{{ $product->name }}</a>
                                            <div class="product-info-stock-sku m-0">
                                              <div>
                                                <label>Type: </label>
                                                <div class="price-box"> <span class="info-deta price"></span>{{ $product::TYPE_SELECT[$product->type] }} </div>
                                              </div>
                                            </div>
                                        </td>
                                        <td>
                                          <div data-id="100" class="total-price price-box"> 
                                            <span id="total_rent_view" class="price"></span> 
                                          </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('rent-'.$prodType.'s') }}">  
                                        <i class="fa fa-trash cart-remove-item" data-id="100" title="Remove Item From Cart"></i>
                                            </a>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="cart-total-table commun-table mb-30 mb-sm-15">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th colspan="2">Term & Conditions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Please bring a photo copy of your ID proof (with address). Bring original to verify.</td>
                                      </tr>
                                      <tr>
                                        <td>If you do not belong to Ahmedabad, please bring a copy of rent agreement and driving license</td>
                                      </tr>
                                      <tr>
                                        <td>Rental amount to be paid in full before reciving the {{ ucfirst($prodType) }}.</td>
                                      </tr>
                                      <tr>
                                        <td>Rental {{ ucfirst($prodType) }} is the property of <b>"The Revolution Store"</b>.</td>
                                      </tr>
                                      <tr>
                                        <td>All repairs and services will be done only and only at <b>"The Revolution Store"</b></td>
                                      </tr>
                                      <tr>
                                        <td>Any damage to the {{ ucfirst($prodType) }} should be reported immediately to <b>"The Revolution Store"</b></td>
                                      </tr>
                                      @if($prodType == "cycle")
                                        <tr>
                                          <td>Helmet is compulsory while riding.</b></td>
                                        </tr>
                                      @endif
                                      <tr>
                                        <td>Riding at night is really risky, please have sufficient lights and reflective material while riding at night.</td>
                                      </tr>
                                      <tr>
                                        <td>In case  of loss due to accident/theft/vandalism, you will be responsible to pay all the damages at MRP of the {{ ucfirst($prodType) }}.</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="right-side float-none-xs"> <a href="javascript:void(0)" onclick="loadPayment();" class="btn btn-color">Next</a> </div>
                            </div>
                            <div class="col-xl-4 col-lg-5">
                              <div class="cart-total-table address-box commun-table mb-30">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Personal Details</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <ul>
                                            <li class="inner-heading"> <b>{{ Auth::user()->username }}</b> </li>
                                            <li>
                                              <p>{{ Auth::User()->add1 }}</p>
                                            </li>
                                            <li>
                                              <p>{{ Auth::User()->add2 }}</p>
                                            </li>
                                            <li>
                                              <p>{{ Auth::User()->city }} - {{ Auth::User()->pincode }}</p>
                                            </li>
                                            <li>
                                              <p>Mobile: {{  Auth::User()->mobile }}</p>
                                            </li>
                                          </ul>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="cart-total-table address-box commun-table">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Pickup Address:</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <ul>
                                            <li class="inner-heading"> <b>The Revolution Store</b> </li>
                                            <li>
                                              <p>H P Petrol Pump</p>
                                            </li>
                                            <li>
                                              <p>Mansi Cross Roads</p>
                                            </li>
                                            <li>
                                              <p>Ahmedabad</p>
                                            </li>
                                          </ul>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                        <!-- Overview Content END -->


                        <!-- Payment Content -->
                        
                        <div class="checkout-content" id="payment" style="display:none">
                          <div class="row">
                            <div class="col-12">
                              <div class="heading-part align-center">
                                <h2 class="heading">Select a payment method</h2>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-8 col-md-8 ">
                              <div class="payment-option-box mb-30">
                                <div class="payment-option-box-inner gray-bg">
                                  <div class="payment-top-box">
                                    <div class="radio-box left-side"> <span>
                                      <input type="radio" id="razorpay" value="3" name="payment_type" checked="true">
                                      </span>
                                      <label for="paypal">RazorPay</label>
                                    </div>
                                    <div class="paypal-box">
                                      <div class="paypal-top"> <img src="{{ asset('frontend/images/paypal-img.png') }}" alt="Revolution Bike Store"> </div>
                                      <div class="paypal-img"> <img src="{{ asset('frontend/images/payment-method.png') }}" alt="Revolution Bike Store"> </div>
                                    </div>
                                  </div>
                                  <p>Payment can be submitted in INR currency only.</p>
                                </div>
                              </div>
                              <div class="payment-option-box mb-30">
                                <div class="payment-option-box-inner gray-bg">
                                  <div class="payment-top-box">
                                    <div class="radio-box left-side"> <span>
                                      <input type="radio" id="cash" value="1" name="payment_type">
                                      </span>
                                      <label for="cash">Would you like to pay by Cash at Store during pickup?</label>
                                    </div>
                                  </div>
                                  <p>Vestibulum semper accumsan nisi, at blandit tortor maxi'mus in phasellus malesuada sodales odio, at dapibus libero malesuada quis.</p>
                                </div>
                              </div>
                              <div class="right-side float-none-xs"> <button type="button" class="btn btn-color btn-submit">Checkout</button></div>
                            </div>
                          </div>
                        </div>
                      <!-- Payment Content END -->
                  </div>
              </div>
          </div>
      </section>
      <!-- CONTAINER END -->

      @include('frontend.layouts.footer')

      <script type="text/javascript">
    $('#from_date').datetimepicker({
    format: 'DD-MM-YYYY',
    defaultDate: new Date() ,
    locale: 'en',
    collapse:true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
});
$('#from_date').on('dp.change', function() {
    getdate();
});


$(document).ready(function() {
    $('#overview').hide();
    $("#total_hours_div").hide();
    $("#price_per_day_div").hide();
    upd_days();
});

function loadOverview(){
    $('#details').hide();
    $('#step1').removeClass('active');
    $('#step2').addClass('active');
    $('#overview').show();
}

function loadPayment(){
    $('#overview').hide();
    $('#step2').removeClass('active');
    $('#step3').addClass('active');
    $('#payment').show();
}

function getdate() {
    var from_date = document.getElementById('from_date').value;
    var date = Date(from_date);
    var newdate = new Date(date);
    var days = document.getElementById('sel_days').value;
    if(days == 0){
        newdate.setDate(newdate.getDate());
    }else{
        newdate.setDate(newdate.getDate() + parseInt(days));
    }
    
    var dd = newdate.getDate();
    var m = newdate.getMonth() + 1;
    var y = newdate.getFullYear();
    
    if(m <= 9)
    m = '0'+m;
    if(dd <= 9)
    dd = '0'+dd;
    var FormattedDate = dd + '-' + m + '-' + y;
    document.getElementById('to_date').value = FormattedDate;
    $('#total_days').val(days);
}

function upd_days() {
    getdate();
    var sel_days = $('#sel_days').val();
    var rent = Math.round($('#rent_per_month').val());
    if(sel_days == 1){
      var total_rent = $('#rent_per_day').val();
      $('#price_per_day').val(total_rent);
      $('#total_rent').val(total_rent);
      $('#total_rent_view').html(total_rent);
    }else if(sel_days == 7){
      var total_rent = $('#rent_per_week').val();
      $('#price_per_day').val(total_rent);
      $('#total_rent').val(total_rent);
      $('#total_rent_view').html(total_rent);
    }else if(sel_days == 15){
      var total_rent = $('#rent_per_fortnight').val();
      $('#price_per_day').val(total_rent);
      $('#total_rent').val(total_rent);
      $('#total_rent_view').html(total_rent);
    }else{
      if(rent != ''){
        var total_rent = Math.round(sel_days * (rent/30));
        $('#price_per_day').val(Math.round(total_rent/30));
        $('#total_rent').val(total_rent);
        $('#total_rent_view').html(total_rent);
      }else{
          $('#total_rent').val('');
      }
    }
    

}

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".btn-submit").click(function(e){
        var payment_type = "";
        e.preventDefault();
        if($('#razorpay').is(':checked')) { payment_type = 'razorpay'; }
        if($('#cash').is(':checked')) { payment_type = 'cash'; }
        var prod_id = $("input[name=prod_id]").val();
        var prod_type = $("input[name=prod_type]").val();
        var sel_days = $('#sel_days').find(":selected").val();
        var from_date = $("input[name=from_date]").val();
        var to_date = $("input[name=to_date]").val();
   
        $.ajax({
           type:'POST',
           url:"{{ route('frontend.complete-checkout') }}",
           data:{prod_id:prod_id, prod_type:prod_type, sel_days:sel_days, from_date:from_date, to_date:to_date, payment_type:payment_type},
           success:function(data){
             if(data == "rented"){
               alert("This product has already been rented!");
             }else{
               window.location.href = data;
             }
              
           }
        });
  
    });

</script>