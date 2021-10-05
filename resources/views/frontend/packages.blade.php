@include('frontend.layouts.header')

<style type="text/css">
  * {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>
      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Packages</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
                <li><span>Packages</span></li>
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
              <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-8 ">
                  <div class="row">
                    <div class="col-12 mb-20">
                      <div class="heading-part heading-bg">
                        <h2 class="heading">Packages</h2>
                      </div>

                      @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                        <p>{{ $message }}</p>
                      </div>
                      @endif
                    </div>
                  </div>
                  @foreach ($packagecafes as $packagecafe)
                    <div class="columns">
                      <ul class="price">
                        <li class="header">{{ $packagecafe->package_name }}</li>
                        <li class="grey">Rs. {{ $packagecafe->total_price }}<sup>*</sup></li>                        
                        <li class="">{{ $packagecafe->price_per_hour }}/- Per Hour</li>
                        <li class="">Validity {{ $packagecafe->validity }} Months</li>
                        <li>{{ $packagecafe->total_hours }} Total Hours</li>
                        <li><sup>*</sup>Taxes as applicable</li>
                        <li class="grey">

                          @auth
                            @if($user_package == "Package_".$packagecafe->id)
                            Subscribed
                            @else
                              <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                  @csrf
                                  <script src="https://checkout.razorpay.com/v1/checkout.js"
                                          data-key="{{ env('RAZORPAY_KEY') }}"
                                          data-amount="{{ ($packagecafe->total_price*100) + ($packagecafe->total_price*100) * ($packagecafe->package_tax/100) }}"
                                          data-buttontext="Buy Now"
                                          data-name="RevolutionBikeCafe.com"
                                          data-description="Package_{{ $packagecafe->id }}"
                                          data-notes.registration_type_id="{{ $packagecafe->id }}"
                                          data-notes.registration_type="Package"
                                          data-image=""
                                          data-prefill.name="name"
                                          data-prefill.email="email"
                                          data-theme.color="#ff7529"
                                          data-class="btn btn-info">
                                  </script>
                              </form>
                            @endif
                      @else
                              {!! Form::open(['method' => 'GET','route' => ['login'],'style'=>'display:inline']) !!}
                            {!! Form::submit('Buy Now', ['class' => 'btn btn-info']) !!}
                            {!! Form::close() !!}
                          @endauth
                        </li>
                      </ul>
                    </div>                   
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- CONTAINER END --> 
       @include('frontend.layouts.footer')