@include('frontend.layouts.header')
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Checkout</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
                <li><a href="cart.html">Cart</a>/</li>
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
                  <li> <a href="checkout.html">
                    <div class="step">
                      <div class="line"></div>
                      <div class="circle">1</div>
                    </div>
                    <span>Shipping</span> </a> </li>
                  <li> <a href="order-overview.html">
                    <div class="step">
                      <div class="line"></div>
                      <div class="circle">2</div>
                    </div>
                    <span>Order Overview</span> </a> </li>
                  <li> <a href="payment.html">
                    <div class="step">
                      <div class="line"></div>
                      <div class="circle">3</div>
                    </div>
                    <span>Payment</span> </a> </li>
                  <li class="active"> <a href="order-complete.html">
                    <div class="step">
                      <div class="line"></div>
                      <div class="circle">4</div>
                    </div>
                    <span>Order Complete</span> </a> </li>
                  <li>
                    <div class="step">
                      <div class="line"></div>
                    </div>
                  </li>
                </ul>
                <hr>
              </div>
              <div class="checkout-content">
                <div class="row">
                  <div class="col-12">
                    <div class="heading-part align-center">
                      <h2 class="heading">Order Overview</h2>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-8 col-lg-7 mb-sm-30">
                    <div id="form-print" class="admission-form-wrapper">
                      <div class="cart-item-table complete-order-table commun-table mb-30">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Product</th>
                                <th>Product Detail</th>
                                <th>Total Rent</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <a href="product-page.html">
                                    <div class="product-image">
                                      <img alt="{{ App\Models\Cycle::find($rental->cycle_id)->name }}" src="{{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->photo[0]->url : App\Models\Trainer::find($rental->trainer_id)->photo[0]->url }}">
                                    </div>
                                  </a>
                                </td>
                                <td>
                                  <div class="product-title"> 
                                    <a href="product-page.html">Brand: {{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->name : App\Models\Trainer::find($rental->trainer_id)->name }}</a>
                                    <div class="product-info-stock-sku m-0">
                                    </div>
                                    <div class="product-info-stock-sku m-0">
                                      <div>
                                        <label>Type: </label>
                                        <span class="info-deta">{{ ($prod == 'cycle') ? App\Models\Cycle::TYPE_SELECT[App\Models\Cycle::find($rental->cycle_id)->type] : App\Models\Trainer::TYPE_SELECT[App\Models\Trainer::find($rental->trainer_id)->type]}}</span> 
                                      </div>
                                    </div>
                                    <div>
                                        <label>Serial No.: </label>
                                        <span class="info-deta">{{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->serial_number : App\Models\Trainer::find($rental->trainer_id)->serial_number }}</span> 
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="product-info-stock-sku m-0">
                                    <div>
                                      <label>Price: </label>
                                      <div class="price-box"> 
                                        <span class="info-deta price">Rs. {{ $rental->total_rent }}</span> 
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="complete-order-detail commun-table mb-30">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td><b>Total Days :</b></td>
                                <td>{{ $rental->total_days}} {{ ($rental->total_days == 1) ? 'Day' : 'Days' }}</td>
                              </tr>
                              <tr>
                                <td><b>Rental Start Date:</b></td>
                                <td><div class="price-box"> <span class="price">{{ $rental->from_date }}</span> </div></td>
                              </tr>
                              <tr>
                                <td><b>Rental End Date:</b></td>
                                <td><div class="price-box"> <span class="price">{{ $rental->to_date }}</span> </div></td>
                              </tr>
                              <tr>
                                <td><b>Payment :</b></td>
                                <td>Paid</td>
                              </tr>
                              <tr>
                                <td><b>Contract No. :</b></td>
                                <td>Rent/21-22/{{ $rental->id }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="">
                        <div class="heading-part">
                          <h3 class="sub-heading">Order Confirmation</h3>
                        </div>
                        <hr>
                        <p class="mt-20">Rental {{ ucfirst($prod) }} Should be returned before the Due Date failing which </p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="print-btn">
                          <button onclick="printDiv('form-print')" class="btn btn-color" type="button">Print</button>
                          <div class="right-side"> 
                            <a class="btn btn-black" href="{{ route('rent-'.$prod.'s') }}">
                              <span><i class="fa fa-angle-left"></i></span>Continue Shopping
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
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
            </div>
          </div>
        </div>
      </section>
      <!-- CONTAINER END --> 
      @include('frontend.layouts.footer')