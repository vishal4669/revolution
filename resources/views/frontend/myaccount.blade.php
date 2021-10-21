@include('frontend.layouts.header')
      
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Account</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
                <li><span>Account</span></li>
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
            <div class="col-lg-3">
              <div class="account-sidebar account-tab mb-sm-30">
                <div class="dark-bg tab-title-bg">
                  <div class="heading-part">
                    <div class="sub-title"><span></span> My Account</div>
                  </div>
                </div>
                <div class="account-tab-inner">
                  <ul class="account-tab-stap">
                    <li id="step1" class="active"> <a href="javascript:void(0)">My Dashboard<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step2"> <a href="javascript:void(0)">Account Details<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step3"> <a href="javascript:void(0)">My Packages<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step4"> <a href="javascript:void(0)">My Cycle Rentals<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step5"> <a href="javascript:void(0)">My Trainer Rentals<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step6"> <a href="javascript:void(0)">My Event Registrations<i class="fa fa-angle-right"></i> </a> </li>
                    <li id="step7"> <a href="javascript:void(0)">Change Password<i class="fa fa-angle-right"></i> </a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div id="data-step1" class="account-content" data-temp="tabdata">
                <div class="row">
                  <div class="col-12">
                    <div class="heading-part heading-bg mb-30">
                      <h2 class="heading m-0">Account Dashboard</h2>
                    </div>
                  </div>
                </div>
                <div class="mb-30">
                  <div class="row">
                    <div class="col-12">
                      <div class="heading-part">
                        <h3 class="sub-heading">Hello, {{ $user->full_name }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="m-0">
                  <div class="row">
                    <div class="col-12 mb-20">
                      <div class="heading-part">
                        <h3 class="sub-heading">Account Information</h3>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-6 mb-xs-30">
                      <div class="cart-total-table address-box commun-table">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Registered Address</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><ul>
                                    <li class="inner-heading"> <b>{{ $user->full_name }}</b> </li>
                                    <li>
                                      <p>{{ $user->add1 }}</p>
                                    </li>
                                    <li>
                                      <p>{{ $user->add2 }}</p>
                                    </li>
                                    <li>
                                      <p>{{ $user->city }} - {{ $user->pincode }}</p>
                                    </li>
                                  </ul></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="data-step2" class="account-content" data-temp="tabdata" style="display:none">
              <form class="main-form full" name="registerfrm"  method="POST" action="3">
                    <div class="personal-details mb-30">
                      <div class="row">                        
                        <div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Name and Mobile Number</h2>
                          </div>
                        </div>
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="f-name" class="col-lg-3 control-label">First Name</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" id="f-name" name="fname" value="{{ old('fname', $user->fname) }}" required placeholder="First Name">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="l-name" class="col-lg-3 control-label">Last Name</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" id="l-name" name="lname" value="{{ old('lname', $user->lname) }}" required placeholder="Last Name">
                              </div>
                            </div>
                          </div>
                        </div>
                      <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="mobile" class="col-lg-3 control-label">Mobile Number</label>
                              <div class="col-lg-9">
                                <input type="number" class="form-control" id="mobile" readonly name="mobile" value="{{ old('mobile', $user->mobile) }}" required placeholder="10 Digit Mobile Number">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="your-address mb-30">
                      <div class="row">
                        <div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Address</h2>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="input-address-1" class="col-lg-3 control-label">Address 1</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="add1" value="{{ old('add1', $user->add1) }}" id="input-address-1" required placeholder="Address 1">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="input-address-2" class="col-lg-3 control-label">Address 2</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="add2" value="{{ old('add2', $user->add2) }}" id="input-address-2"  placeholder="Address 2">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="input-city" class="col-lg-3 control-label">City</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="city" id="input-city" value="{{ old('city', $user->city) }}" required placeholder="City">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="input-pincode" class="col-lg-3 control-label">Pin Code</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="pincode" value="{{ old('pincode', $user->pincode) }}" id="input-pincode" required placeholder="Pin Code">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box select-dropdown">
                            <div class="row">
                              <label for="input-state" class="col-lg-3 control-label">Select a State</label>
                              <div class="col-lg-9">
                                <fieldset>
                                  <select name="state" class="option-drop" id="input-state registerstateid">
                                    <option value="">Select a State</option>
                                    <option value="AP">Andhra Pradesh</option>
                                    <option value="AR">Arunachal Pradesh</option>
                                    <option value="AS">Assam</option>
                                    <option value="BR">Bihar</option>
                                    <option value="CT">Chhattisgarh</option>
                                    <option value="GA">Goa</option>
                                    <option value="GJ" selected>Gujarat</option>
                                    <option value="HR">Haryana</option>
                                    <option value="HP">Himachal Pradesh</option>
                                    <option value="JK">Jammu and Kashmir</option>
                                    <option value="JH">Jharkhand</option>
                                    <option value="KA">Karnataka</option>
                                    <option value="KL">Kerala</option>
                                    <option value="MP">Madhya Pradesh</option>
                                    <option value="MH">Maharashtra</option>
                                    <option value="MN">Manipur</option>
                                    <option value="ML">Meghalaya</option>
                                    <option value="MZ">Mizoram</option>
                                    <option value="NL">Nagaland</option>
                                    <option value="OR">Orissa</option>
                                    <option value="PB">Punjab</option>
                                    <option value="RJ">Rajasthan</option>
                                    <option value="SK">Sikkim</option>
                                    <option value="TN">Tamil Nadu</option>
                                    <option value="TS">Telangana</option>
                                    <option value="TR">Tripura</option>
                                    <option value="UK">Uttarakhand</option>
                                    <option value="UP">Uttar Pradesh</option>
                                    <option value="WB">West Bengal</option>
                                    <option value="AN">Andaman and Nicobar Islands</option>
                                    <option value="CH">Chandigarh</option>
                                    <option value="DN">Dadar and Nagar Haveli</option>
                                    <option value="DD">Daman and Diu</option>
                                    <option value="DL">Delhi</option>
                                    <option value="LD">Lakshadeep</option>
                                    <option value="PY">Pondicherry (Puducherry)</option>
                                  </select>
                                </fieldset>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="your-address">
                      <div class="row">
                        <div class="col-12">
                          <div class="heading-part line-bottom ">
                            <h2 class="form-title heading">Your Username & Email</h2>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="username" class="col-lg-3 control-label">Username</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" id="username" readonly value="{{ old('username', $user->username) }}" name="username" placeholder="Username">
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <div class="col-12">
                          <div class="input-box">
                            <div class="row">
                              <label for="login-email" class="col-lg-3 control-label">Email address</label>
                              <div class="col-lg-9">
                                <input type="email" class="form-control" name="email" id="email" readonly value="{{ old('email', $user->email) }}" placeholder="Email address">
                              </div>
                            </div>
                          </div>
                        </div>                     

                      </div>
                    </div>
                    <div class="Submit-btn">
                      <div class="row">
                        <div class="col-12">                       
                          <button type="submit" class="btn-color right-side">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>
              </div>
              <div id="data-step3" class="account-content" data-temp="tabdata" style="display:none">
                <div id="form-print" class="admission-form-wrapper">
                  <div class="row">
                    <div class="col-12">
                      <div class="heading-part heading-bg mb-30">
                        <h2 class="heading m-0">My Packages</h2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>
                                  Sr. No.
                                </th>
                                <th>
                                  Package Name
                                </th>
                                <th>
                                  Price
                                </th>
                                <th>
                                  Wallet Hours
                                </th>
                                <th>
                                  Start Date
                                </th>
                                <th>
                                  Expiry Date
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(count($packages) > 0)
                              @foreach($packages as $package)
                                <tr>
                                  <td>
                                    {{ $loop->iteration }}
                                  </td>
                                  <td>
                                    {{ $package->package->package_name }}
                                  </td>
                                  <td>
                                    <div class="base-price price-box"> 
                                      <span class="price">Rs.{{ $package->amount_received }}</span> 
                                    </div>
                                  </td>
                                  <td>
                                    {{ $package->package->total_hours }} hrs
                                  </td>
                                  <td>
                                    {{ date('d-m-Y', strtotime($package->created_at)); }}
                                  </td>
                                  <td>
                                  {{ date('d-m-Y', strtotime($package->created_at->addYear())); }}
                                  </td>
                                </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="6">You have not subscribed to any packages.</td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-12">
                    <div class="print-btn text-center mt-30">
                      <button onclick="printDiv('form-print')" class="btn btn-color" type="button">Print Invoice</button>
                    </div>
                  </div>
               </div> -->

              </div>

              <div id="data-step4" class="account-content" data-temp="tabdata" style="display:none">
                <div id="form-print" class="admission-form-wrapper">
                  <div class="row">
                    <div class="col-12">
                      <div class="heading-part heading-bg mb-30">
                        <h2 class="heading m-0">Cycles Rentals</h2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>
                                  Sr. No.
                                </th>
                                <th>
                                  Cycle
                                </th>
                                <th>
                                  From Date
                                </th>
                                <th>
                                  To Date
                                </th>
                                <th>
                                  Total Rent
                                </th>
                                <th>
                                  Status
                                </th>
                                <th>
                                  Action
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(count($cycleRentals) > 0)
                              @foreach($cycleRentals as $cycleRental)
                                <tr>
                                  <td>
                                    {{ $loop->iteration }}
                                  </td>
                                  <td>
                                    {{ $cycleRental->cycle->name }}
                                  </td>
                                  <td>
                                    {{ date('d-m-Y', strtotime($cycleRental->from_date)); }}
                                  </td>
                                  <td>
                                    {{ date('d-m-Y', strtotime($cycleRental->to_date)); }}
                                  </td>
                                  <td>
                                    <div class="base-price price-box"> 
                                      <span class="price">Rs.{{ $cycleRental->total_rent }}</span> 
                                    </div>
                                  </td>
                                  <td>
                                    {{ $cycleRental->status }}
                                  </td>
                                  <td>
                                    <button class="btn btn-primary btn-sm">Extend</button>
                                  </td>
                                </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="7">You have not rented any cycles.</td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-12">
                    <div class="print-btn text-center mt-30">
                      <button onclick="printDiv('form-print')" class="btn btn-color" type="button">Print Invoice</button>
                    </div>
                  </div>
               </div> -->

              </div>

              <div id="data-step5" class="account-content" data-temp="tabdata" style="display:none">
                <div id="form-print" class="admission-form-wrapper">
                  <div class="row">
                    <div class="col-12">
                      <div class="heading-part heading-bg mb-30">
                        <h2 class="heading m-0">Trainer Rentals</h2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>
                                  Sr. No.
                                </th>
                                <th>
                                  Cycle
                                </th>
                                <th>
                                  From Date
                                </th>
                                <th>
                                  To Date
                                </th>
                                <th>
                                  Total Rent
                                </th>
                                <th>
                                  Status
                                </th>
                                <th>
                                  Action
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(count($trainerRentals) > 0)
                              @foreach($trainerRentals as $trainerRental)
                                <tr>
                                  <td>
                                    {{ $loop->iteration }}
                                  </td>
                                  <td>
                                    {{ $trainerRental->trainer->name }}
                                  </td>
                                  <td>
                                    {{ date('d-m-Y', strtotime($trainerRental->from_date)); }}
                                  </td>
                                  <td>
                                    {{ date('d-m-Y', strtotime($trainerRental->to_date)); }}
                                  </td>
                                  <td>
                                    <div class="base-price price-box"> 
                                      <span class="price">Rs.{{ $trainerRental->total_rent }}</span> 
                                    </div>
                                  </td>
                                  <td>
                                    {{ $trainerRental->status }}
                                  </td>
                                  <td>
                                    <button class="btn btn-primary btn-sm">Extend</button>
                                  </td>
                                </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="7">You have not rented any trainers.</td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-12">
                    <div class="print-btn text-center mt-30">
                      <button onclick="printDiv('form-print')" class="btn btn-color" type="button">Print Invoice</button>
                    </div>
                  </div>
               </div> -->

              </div>

              <div id="data-step6" class="account-content" data-temp="tabdata" style="display:none">
                <div id="form-print" class="admission-form-wrapper">
                  <div class="row">
                    <div class="col-12">
                      <div class="heading-part heading-bg mb-30">
                        <h2 class="heading m-0">Booked Tickets</h2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>
                                  Sr. No.
                                </th>
                                <th>
                                  Event
                                </th>
                                <th>
                                  Ticket Type
                                </th>
                                <th>
                                  Quantity
                                </th>
                                <th>
                                  Transaction ID
                                </th>
                                <th>
                                  Amount Paid
                                </th>
                                <th>
                                  Event Date
                                </th>
                                <th>
                                  Reporting Time
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(count($eventRegistrations) > 0)
                              @foreach($eventRegistrations as $eventRegistration)
                                <tr>
                                  <td>
                                    {{ $loop->iteration }}
                                  </td>
                                  <td>
                                    {{ $eventRegistration->event->name }}
                                  </td>
                                  <td>
                                    {{ $eventRegistration->ticket->ticket_name }} 
                                  </td>
                                  <td>
                                    {{ $eventRegistration->no_of_tickets }}
                                  </td>                                  
                                  <td>
                                    {{ $eventRegistration->transaction }}
                                  </td>
                                  <td>
                                    <div class="base-price price-box"> 
                                      <span class="price">Rs.{{ $eventRegistration->amount_received }}</span> 
                                    </div>
                                  </td>
                                  <td>
                                    {{ $eventRegistration->event->event_start_day }}
                                  </td>
                                  <td>
                                   {{ $eventRegistration->event->reporting_time }}
                                  </td>
                                </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="7">You have not rented any trainers.</td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-12">
                    <div class="print-btn text-center mt-30">
                      <button onclick="printDiv('form-print')" class="btn btn-color" type="button">Print Invoice</button>
                    </div>
                  </div>
               </div> -->

              </div>

              <div id="data-step7" class="account-content" data-temp="tabdata" style="display:none">
                <div class="row">
                  <div class="col-12">
                    <div class="heading-part heading-bg mb-30">
                      <h2 class="heading m-0">Change Password</h2>
                    </div>
                  </div>
                </div>
                <form class="main-form full">
                  <div class="row">
                    <div class="col-12">
                      <div class="input-box">
                        <label for="old-pass">Old-Password</label>
                        <input type="password" placeholder="Old Password" required id="old-pass">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-box">
                        <label for="login-pass">Password</label>
                        <input type="password" placeholder="Enter your Password" required id="login-pass">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-box">
                        <label for="re-enter-pass">Re-enter Password</label>
                        <input type="password" placeholder="Re-enter your Password" required id="re-enter-pass">
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn-color" type="submit" name="submit">Change Password</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- CONTAINER END --> 

      @include('frontend.layouts.footer')
