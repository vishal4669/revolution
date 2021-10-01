@include('frontend.layouts.header');

      <div class="sidebar-search-wrap">
        <div class="sidebar-table-container">
          <div class="sidebar-align-container">
            <div class="search-closer right-side"></div>
            <div class="search-container">
              <form method="get" id="search-form">
                <input type="text" id="s" class="search-input" name="s" placeholder="Start Searching">
              </form>
              <span>Search and Press Enter</span>
            </div>
          </div>
        </div>
      </div>
      <!-- HEADER END --> 
      
      <!-- CONTAIN START ptb-95-->
      <section class="ptb-70 gray-bg error-block-main">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="error-block-detail error-block-bg">
                <div class="row">
                  <div class="col-xl-5 col-lg-6"></div>
                  <div class="col-xl-7 col-lg-6">
                    <div class="main-error-text">401</div>
                    <div class="error-small-text">We are Sorry</div>
                    <div class="error-slogan">You are not Authorised to view this page.</div>
                    <ul class="social-icon mb-20">
                      <li><a href="https://facebook.com/revolutionpremiumbikestore" target="_blank" title="Facebook" class="facebook"><i class="fa fa-facebook"> </i></a></li>
                      <li><a href="https://instagram.com/revolution_bikestore" target="_blank" title="Instagram" class="instagram"><i class="fa fa-instagram"> </i></a></li>
                    </ul>
                    <div class="middle-580">
                      <p>And while you are here, please spare sometime to like us on facebook and instagram.</p>
                    </div>
                    <div class="mt-40"> <a href="{{ route('home') }}" class="btn btn-color">Back to Home</a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bottom-shadow">
          <img alt="Roadie" src="images/bottom-shadow.png">
        </div>
      </section>
      <!-- CONTAINER END --> 
      @include('frontend.layouts.footer');