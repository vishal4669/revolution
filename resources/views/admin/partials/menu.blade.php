<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Revolution Bike Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("dashboard") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is("packagecafes*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-bicycle">

                        </i>
                        <p>
                            Masters
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route("packagecafes.index") }}" class="nav-link {{ request()->is("packagecafes") || request()->is("packagecafes/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon far fa-file-alt">

                                    </i>
                                    <p>
                                        Packages
                                    </p>
                                </a>
                            </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is("trainerbookingcafes*") ? "menu-open" : "" }} {{ request()->is("trainerbookingrentals*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-bicycle">

                        </i>
                        <p>
                            Book & Rent Trainers
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route("trainerbookingcafes.create") }}" class="nav-link {{ request()->is("trainerbookingcafes") || request()->is("trainerbookingcafes/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-bicycle">

                                    </i>
                                    <p>
                                        Book a Trainer
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("trainerbookingrentals.create") }}" class="nav-link {{ request()->is("trainerbookingrentals") || request()->is("trainerbookingrentals/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon far fa-file-alt">

                                    </i>
                                    <p>
                                        Rent a Trainer
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("trainerbookingcafes.index") }}" class="nav-link {{ request()->is("trainerbookingcafes.index") || request()->is("packagecafes/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon far fa-file-alt">

                                    </i>
                                    <p>
                                        View Bookings
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("trainerbookingrentals.index") }}" class="nav-link {{ request()->is("trainerbookingrentals") || request()->is("trainerbookingrentals/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon far fa-file-alt">

                                    </i>
                                    <p>
                                        View Rentals
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("bookings.index") }}" class="nav-link {{ request()->is("bookings") || request()->is("bookings/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon far fa-file-alt">

                                    </i>
                                    <p>
                                        All Bookings & Rentals
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("slots.block") }}" class="nav-link {{ request()->is("slots") || request()->is("slots/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon far fa-file-alt">

                                    </i>
                                    <p>
                                        Block Slots
                                    </p>
                                </a>
                            </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{ request()->is("cycles*") ? "menu-open" : "" }} {{ request()->is("renting-cycles*") ? "menu-open" : "" }} {{ request()->is("cycle-expenses*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-bicycle">

                        </i>
                        <p>
                            {{ trans('cruds.cycleModule.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("cycles.index") }}" class="nav-link {{ request()->is("cycles") || request()->is("cycles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-bicycle">

                                </i>
                                <p>
                                    {{ trans('cruds.cycle.title') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("renting-cycles.index") }}" class="nav-link {{ request()->is("renting-cycles") || request()->is("renting-cycles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-file-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.rentingCycle.title') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("cycle-expenses.index") }}" class="nav-link {{ request()->is("cycle-expenses") || request()->is("cycle-expenses/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-screwdriver">

                                </i>
                                <p>
                                    {{ trans('cruds.cycleExpense.title') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is("trainers*") ? "menu-open" : "" }} {{ request()->is("renting-trainers*") ? "menu-open" : "" }} {{ request()->is("trainer-expenses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-bicycle">

                            </i>
                            <p>
                                {{ trans('cruds.trainerModule.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("trainers.index") }}" class="nav-link {{ request()->is("trainers") || request()->is("trainers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bicycle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.trainer.title') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("renting-trainers.index") }}" class="nav-link {{ request()->is("renting-trainers") || request()->is("renting-trainers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-receipt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rentingTrainer.title') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("trainer-expenses.index") }}" class="nav-link {{ request()->is("trainer-expenses") || request()->is("trainer-expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-screwdriver">

                                        </i>
                                        <p>
                                            {{ trans('cruds.trainerExpense.title') }}
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                <li class="nav-item">
                    <a href="{{ route("systemCalendar") }}" class="nav-link {{ request()->is("system-calendar") || request()->is("system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is("events*") ? "menu-open" : "" }} {{ request()->is("tickets*") ? "menu-open" : "" }} {{ request()->is("event-registrations*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon far fa-calendar-alt">

                        </i>
                        <p>
                            {{ trans('cruds.eventsModule.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route("events.index") }}" class="nav-link {{ request()->is("events") || request()->is("events/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-cogs">

                                    </i>
                                    <p>
                                        {{ trans('cruds.event.title') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("tickets.index") }}" class="nav-link {{ request()->is("tickets") || request()->is("tickets/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-ticket-alt">

                                    </i>
                                    <p>
                                        {{ trans('cruds.ticket.title') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("event-registrations.index") }}" class="nav-link {{ request()->is("event-registrations") || request()->is("event-registrations/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-user-plus">

                                    </i>
                                    <p>
                                        {{ trans('cruds.eventRegistration.title') }}
                                    </p>
                                </a>
                            </li>
                    </ul>
                </li>
                    <li class="nav-item">
                        <a href="{{ route("brands.index") }}" class="nav-link {{ request()->is("brands") || request()->is("brands/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-image">

                            </i>
                            <p>
                                {{ trans('cruds.brand.title') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("testimonials.index") }}" class="nav-link {{ request()->is("testimonials") || request()->is("testimonials/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-comment-alt">

                            </i>
                            <p>
                                {{ trans('cruds.testimonial.title') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("settings.create") }}" class="nav-link {{ request()->is("settings") || request()->is("settings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-comment-alt">
                            </i>
                            <p>
                                Settings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("trainer-settings.index") }}" class="nav-link {{ request()->is("trainer-settings") || request()->is("trainer-settings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.trainerSetting.title') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("cycle-settings.index") }}" class="nav-link {{ request()->is("cycle-settings") || request()->is("cycle-settings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.cycleSetting.title') }}
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>