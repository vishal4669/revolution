@include('frontend.layouts.header')

     
      <!-- Bread Crumb STRAT -->
      <div class="banner inner-banner1 ">
        <div class="container">
          <section class="banner-detail center-xs">
            <h1 class="banner-title">Contact</h1>
            <div class="bread-crumb right-side float-none-xs">
              <ul>
                <li><a href="index-2.html">Home</a>/</li>
                <li><span>Contact</span></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <!-- Bread Crumb END -->
      
      <!-- CONTAIN START ptb-95-->
      <section class="ptb-70">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-part align-center mb-30">
                <h2 class="main_title  heading"><span>Leave a message!</span></h2>
              </div>
              @if(session()->has('success'))
                  <div class="alert alert-success">
                      {{ session()->get('success') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="main-form">
            <form action="{{ route('frontend.contact-message') }}" method="POST" name="contactform">
              @csrf
              <div class="row">
                <div class="col-md-4 mb-30">
                  <input type="text" required placeholder="Name" id="name" name="name" required>
                </div>
                <div class="col-md-4 mb-30">
                  <input type="email" required placeholder="Email" id="email" name="email" required>
                </div>
                <div class="col-md-4 mb-30">
                  <input type="number" required placeholder="Mobile (10 Digits)" id="mobile" name="mobile" required>
                </div>
                <div class="col-12 mb-30">
                  <textarea required placeholder="Message" rows="3" cols="30" id="message" name="message"></textarea>
                </div>
                <div class="col-12">
                  <div class="align-center">
                    <button type="submit" class="btn btn-color">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      <section class="pt-70 client-main align-center">
        <div class="container">
          <div class="contact-info">
            <div class="row m-0">
              <div class="col-md-4 p-0">
                <div class="contact-box">
                  <div class="contact-icon contact-phone-icon"></div>
                  <span><b>Tel</b></span>
                  <p>079 4030 3732</p>
                </div>
              </div>
              <div class="col-md-4 p-0">
                <div class="contact-box">
                  <div class="contact-icon contact-mail-icon"></div>
                  <span><b>Mail</b></span>
                  <p>info@revolutionbikecafe.com </p>
                </div>
              </div>
              <div class="col-md-4 p-0">
                <div class="contact-box">
                  <div class="contact-icon contact-open-icon"></div>
                  <span><b>Open</b></span>
                  <p>Mon – Sun: 10:00 – 20:00</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="pt-70">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="map">
                <div class="map-part">
                  <div id="map" class="map-inner-part"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.7763746805135!2d72.52223051403018!3d23.031981684948306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84ca38ef7091%3A0x3f914a00f389a3ff!2sRevolution%20Bike%20Store!5e0!3m2!1sen!2sin!4v1631165308727!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- CONTAINER END --> 
      
@include('frontend.layouts.footer')