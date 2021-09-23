  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
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
                <li class="nav-item {{ request()->is("dashboard*") ? "menu-open" : "" }} ">
                    <a class="nav-link" href="{{ route("dashboard") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="masters_nav">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Masters
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                        <ul class="nav nav-treeview"  id="masters_treeview">
                                <li class="nav-item">
                                    <a href="{{ route('trainers.index') }}" class="nav-link {{ ($route_name=='trainers.index') || ($route_name=='trainers.create') || ($route_name=='trainers.edit')  ? 'active': '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                          Trainers
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('packagecafes.index') }}" class="nav-link {{ ($route_name=='packagecafes.index') || ($route_name=='packagecafes.create') || ($route_name=='packagecafes.edit') ? 'active': '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                          Packages
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>

                <li class="nav-item" id="trainers_nav">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Book & Rent Trainer
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" id="trainers_treeview">

                      <!--<li class="nav-item">
                        <a href="{{route('packagerentals.create')}}" class="nav-link  {{ ($route_name=='packagerentals.create') ? 'active': '' }}">
                          <p>Package For Trainer Rental</p>
                        </a>
                      </li> -->
                      <li class="nav-item">
                        <a href="{{route('trainerbookingcafes.create')}}" class="nav-link  {{ ($route_name=='trainerbookingcafes.index') ? 'active': '' }}">
                          <p>Book a Trainer</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('trainerbookingrentals.create')}}" class="nav-link  {{ ($route_name=='trainerbookingrentals.create') ? 'active': '' }}">
                          <p>Rent a Trainer</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('trainerbookingcafes.index')}}" class="nav-link  {{ ($route_name=='trainerbookingrentals.index') ? 'active': '' }}">
                          <p>View Bookings</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('trainerbookingrentals.index')}}" class="nav-link  {{ ($route_name=='trainerbookingrentals.index') ? 'active': '' }}">
                          <p>View Rentals</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('bookings.index')}}" class="nav-link {{ ($route_name=='bookings.index') ? 'active': '' }}">
                          <p>All Bookings & Rentals</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('slots.block')}}" class="nav-link {{ ($route_name=='slots.block') ? 'active': '' }}">
                          <p>Block Slots</p>
                        </a>
                      </li>
                      
                    </ul>
                </li> 

                <li class="nav-item">
                    <a href="javascript:void()" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Events
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('events.create') }}" class="nav-link">
                          <p>Create Event</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Create Ticket</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Register For Event</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('events.index') }}" class="nav-link">
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
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Reports</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                          <p>Manage Users</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Create Operator</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
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
                        <a href="{{ route('cycle_master') }}" class="nav-link">
                          <p>Cycle Master</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Cycle Booking</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Add Cycle Expense</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('cycle.index') }}" class="nav-link">
                          <p>View Cycle List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>View Cycle Booking List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Cycle Expanse List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Calander Based on Cycle Booking</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
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
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Marketing Messages</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                          <p>Discount</p>
                        </a>
                      </li>                      
                    </ul>
                </li>  
                 <li class="nav-item">
                    <a href="{{url('settings')}}" class="nav-link  {{ Request::is('settings') ? 'active': '' }}">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Settings
                      </p>
                    </a> 
                </li>  
            </ul>
                 
        </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

