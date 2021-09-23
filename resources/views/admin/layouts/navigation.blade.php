  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
            
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>

            <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>


            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{url('dashboard')}}" class="nav-link  {{ Request::is('dashboard') ? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard                  
                        </p>
                    </a>               
                </li> 

                <li class="nav-item">
                    <a href="{{url('trainers')}}" class="nav-link  {{ Request::is('trainers') ? 'active': '' }}">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Trainers
                      </p>
                    </a> 
                </li> 

                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Trainer Operations
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Package For Trainer Cafe</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Package For Trainer Rental</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Booking For Trainer Cafe</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Booking For Trainer Rental</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Booking Calender For Each Trainer</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Booking List For Trainer Cafe</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Booking List For Trainer Rental</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Block Slots</p>
                        </a>
                      </li>
                      
                    </ul>
                </li> 

                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Events
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Event</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Ticket</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Register For Event</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Manage Event</p>
                        </a>
                      </li>
                    </ul>
                </li>             
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Reports</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Manage Users</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Create Operator</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Manage Operator</p>
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Cycle
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Cycle Master</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Cycle Booking</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Add Cycle Expense</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>View Cycle List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>View Cycle Booking List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Cycle Expanse List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Calander Based on Cycle Booking</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Manage Cycle Rentals</p>
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Promotions
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Marketing Messages</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <p>Discount</p>
                        </a>
                      </li>                      
                    </ul>
                </li>   
            </ul>
                 
        </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>