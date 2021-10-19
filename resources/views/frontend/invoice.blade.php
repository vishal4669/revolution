<link href="{{ public_path('invoice/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/stylesheet">
body {
    background-color: #000
}

.padding {
    padding: 2rem !important
}

.card {
    margin-bottom: 30px;
    border: none;
    -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #e6e6f2
}

h3 {
    font-size: 20px
}

h5 {
    font-size: 15px;
    line-height: 26px;
    color: #3d405c;
    margin: 0px 0px 15px 0px;
    font-family: 'Circular Std Medium'
}

.text-dark {
    color: #3d405c !important
}
</style>
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
         <div class="card-header p-4">
         <img alt="Revolution Bike Cafe" width="150" src="{{ public_path('frontend/images/Logorevolutionbikecafe.png') }}">
             <div class="float-right">
                 <h3 class="mb-0">Invoice #Rent/21-22/{{ $rental->id }}</h3>
                 Date: {{ date('d-m-Y', strtotime($rental->created_at)) }}
             </div>
         </div>
         <div class="card-body">
             <div class="row mb-8">
                 <div class="col-sm-6">
                    <div class="float-left">
                        <h5 class="mb-3">From:</h5>
                        <h3 class="text-dark mb-1">Revolution Bike Cafe</h3>
                        <div>HP Petrol Pump</div>
                        <div>Near Mansi Circle, Ahmedabad</div>
                        <div>Email: info@revolutionbikecafe.com</div>
                        <div>GST: 24ABCDE1234A1ZZ</div>
                        <div>Phone: +91 79 22222222</div>
                    </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="float-right">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1">{{ Auth::user()->full_name }}</h3>
                        <div>{{ Auth::User()->add1 }} {{ Auth::User()->add2 }}</div>
                        <div>{{ Auth::User()->city }} - {{ Auth::User()->pincode }}</div>
                        <div>Email: {{ Auth::User()->email }}</div>
                        <div>Phone:+91 {{ Auth::User()->mobile }}</div>
                    </div>
                 </div>
             </div> 
             <div class="table-responsive-sm">
                 <table class="table">
                     <thead>
                         <tr>
                             <th class="center">#</th>
                             <th>Item</th>
                             <th>Description</th>
                             <th class="right">Price/Day</th>
                             <th class="center">Status</th>
                             <th class="right">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td class="center">1</td>
                             <td class="left strong">
                                 <ul style="list-style:none; padding:0 0 0 0;">
                                     <li>
                                         Brand: {{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->name : App\Models\Trainer::find($rental->trainer_id)->name }}
                                     </li>
                                     <li>
                                         Type: {{ ($prod == 'cycle') ? App\Models\Cycle::TYPE_SELECT[App\Models\Cycle::find($rental->cycle_id)->type] : App\Models\Trainer::TYPE_SELECT[App\Models\Trainer::find($rental->trainer_id)->type] }}
                                     </li>
                                     <li>
                                        Serial No: {{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->serial_number : App\Models\Trainer::find($rental->trainer_id)->serial_number }}
                                     </li>
                                 </ul>
                             </td>
                             <td class="left">
                                 <ul style="list-style:none; padding:0 0 0 0;">
                                     <li>
                                        Days: {{ $rental->total_days}} {{ ($rental->total_days == 1) ? 'Day' : 'Days' }}
                                     </li>
                                     <li>
                                        Start Date: {{ date('d-M-Y', strtotime($rental->from_date))  }}
                                     </li>
                                     <li>
                                        End Date:   {{ date('d-M-Y', strtotime($rental->to_date)) }}
                                     </li>
                                 </ul>
                             </td>
                             <td class="right">Rs. {{ $rental->price_per_day }}</td>
                             <td class="center">{{ $rental->payment_option}} {{ ($rental->payment_option == "razorpay") ? 'PAID' : 'UNPAID' }}</td>
                             <td class="right">Rs. {{ $rental->total_rent }}</td>
                         </tr>
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-5">
                 </div>
                 <div class="col-lg-4 col-sm-5 ml-auto">
                     <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Subtotal</strong>
                                 </td>
                                 <td class="right">Rs. {{ $rental->total_rent }}</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">GST (18%)</strong>
                                 </td>
                                 <td class="right">Rs. {{ round((18*$rental->total_rent)/118, 2) }}</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">Rs. {{ $rental->total_rent  - round((18*$rental->total_rent)/118, 2) }}</strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="card-body bg-white">
            <h5>Terms & Conditions:</h1>
            <ul>
                <li>Please bring a photo copy of your ID proof (with address). Bring original to verify.</li>
                <li>If you do not belong to Ahmedabad, please bring a copy of rent agreement and driving license</li>
                <li>Rental amount to be paid in full before reciving the {{ ucfirst($prod) }}.</li>
                <li>Rental {{ ucfirst($prod) }} is the property of <b>"The Revolution Store"</b>.</li>
                <li>All repairs and services will be done only and only at <b>"The Revolution Store"</b></li>
                <li>Any damage to the {{ ucfirst($prod) }} should be reported immediately to <b>"The Revolution Store"</b></li>
                @if($prod == "cycle")
                    <li>Helmet is compulsory while riding.</b></li>
                    <li>Riding at night is really risky, please wear proper gear and have sufficient lights and reflective material while riding at night.</li>
                @endif
                <li>In case  of loss due to accident/theft/vandalism, you will be responsible to pay all the damages at MRP of the {{ ucfirst($prod) }}.</li>
                <li>Subject to Ahmedabad Jurisdiction</li>
                <li>By signing this Contract cum Bill, you agree to all the above mentioned terms and conditions.</li>
            </ul>
         </div>
        <div class="card-footer bg-white">
            <div class="row">
                <div class="col-md-5">
                    <div class="float-left">
                        Signarture 1:
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        Signarture 1:
                    </div>
                </div>
            </div>
         </div>
     </div>
 </div>