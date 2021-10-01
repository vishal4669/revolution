    <style>
        
    </style>
    <table >
        <tr>
            <td colspan="3" ><img alt="Revolution Bike Cafe" width="100" src="/frontend/images/Logorevolutionbikecafe.png"></td>
            <td></td>
            <td colspan="2">
                Invoice #Rent/21-22/{{ $rental->id }}<br>
                Date: {{ date('d-m-Y', strtotime($rental->created_at)) }}
            </td>
        </tr>
        
        
        <hr width="100%">
    </table>
    
    <table >
    <tr>
        <td colspan="3">
            <p style>From:</p>
            <p>Revolution Bike Cafe</p>
            <p>HP Petrol Pump</p>
            <p>Near Mansi Circle, Ahmedabad</p>
            <p>Email: info@revolutionbikecafe.com</p>
            <p>GST: 24ABCDE1234A1ZZ</p>
            <p>Phone: +91 79 22222222</p>
        </td>
        <td colspan="3">
            <p>To:</p>
            <p>{{ Auth::user()->full_name }}</p>
            <p>{{ Auth::User()->add1 }} {{ Auth::User()->add2 }}</p>
            <p>{{ Auth::User()->city }} - {{ Auth::User()->pincode }}</p>
            <p>Email: {{ Auth::User()->email }}</p>
            <p>Phone:+91 {{ Auth::User()->mobile }}</p>
        </td>
    </tr>
    </table>
    <hr>
    <table>
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
                <td>1</td>
                <td>
                    <p>
                        Brand: {{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->name : App\Models\Trainer::find($rental->trainer_id)->name }}
                    </p>
                    <p>
                        Type: {{ ($prod == 'cycle') ? App\Models\Cycle::TYPE_SELECT[App\Models\Cycle::find($rental->cycle_id)->type] : App\Models\Trainer::TYPE_SELECT[App\Models\Trainer::find($rental->trainer_id)->type] }}
                    </p>
                    <p>
                        Serial No: {{ ($prod == 'cycle') ? App\Models\Cycle::find($rental->cycle_id)->serial_number : App\Models\Trainer::find($rental->trainer_id)->serial_number }}
                    </p>
                </td>
                <td>
                    <p>
                    Days: {{ $rental->total_days}} {{ ($rental->total_days == 1) ? 'Day' : 'Days' }}
                    </p>
                    <p>
                    Start Date: {{ date('d-M-Y', strtotime($rental->from_date))  }}
                    </p>
                    <p>
                    End Date:   {{ date('d-M-Y', strtotime($rental->to_date)) }}
                    </p>
                </td>
                <td>Rs. {{ $rental->price_per_day }}</td>
                <td>UNPAID</td>
                <td>Rs. {{ $rental->total_rent }}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table>
        <tbody>
            <tr>
                <td>
                    Subtotal
                </td>
                <td >
                   Rs. {{ $rental->total_rent  - round((18*$rental->total_rent)/118, 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    GST (18%)
                </td>
                <td>
                    Rs. {{ round((18*$rental->total_rent)/118, 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    Total
                </td>
                <td>
                   Rs. {{ $rental->total_rent }}
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
