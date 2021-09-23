<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('cycle_module_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/cycles*") ? "menu-open" : "" }} {{ request()->is("admin/renting-cycles*") ? "menu-open" : "" }} {{ request()->is("admin/cycle-expenses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-bicycle">

                            </i>
                            <p>
                                {{ trans('cruds.cycleModule.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('cycle_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cycles.index") }}" class="nav-link {{ request()->is("admin/cycles") || request()->is("admin/cycles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bicycle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.cycle.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('renting_cycle_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.renting-cycles.index") }}" class="nav-link {{ request()->is("admin/renting-cycles") || request()->is("admin/renting-cycles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rentingCycle.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('cycle_expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cycle-expenses.index") }}" class="nav-link {{ request()->is("admin/cycle-expenses") || request()->is("admin/cycle-expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-screwdriver">

                                        </i>
                                        <p>
                                            {{ trans('cruds.cycleExpense.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('events_module_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/events*") ? "menu-open" : "" }} {{ request()->is("admin/tickets*") ? "menu-open" : "" }} {{ request()->is("admin/event-registrations*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.eventsModule.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('event_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.event.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('ticket_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tickets.index") }}" class="nav-link {{ request()->is("admin/tickets") || request()->is("admin/tickets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-ticket-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ticket.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('event_registration_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.event-registrations.index") }}" class="nav-link {{ request()->is("admin/event-registrations") || request()->is("admin/event-registrations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.eventRegistration.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('trainer_module_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/trainers*") ? "menu-open" : "" }} {{ request()->is("admin/renting-trainers*") ? "menu-open" : "" }} {{ request()->is("admin/trainer-expenses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-bicycle">

                            </i>
                            <p>
                                {{ trans('cruds.trainerModule.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('trainer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.trainers.index") }}" class="nav-link {{ request()->is("admin/trainers") || request()->is("admin/trainers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bicycle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.trainer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('renting_trainer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.renting-trainers.index") }}" class="nav-link {{ request()->is("admin/renting-trainers") || request()->is("admin/renting-trainers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-receipt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rentingTrainer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('trainer_expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.trainer-expenses.index") }}" class="nav-link {{ request()->is("admin/trainer-expenses") || request()->is("admin/trainer-expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-screwdriver">

                                        </i>
                                        <p>
                                            {{ trans('cruds.trainerExpense.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('brand_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.brands.index") }}" class="nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-image">

                            </i>
                            <p>
                                {{ trans('cruds.brand.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('testimonial_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.testimonials.index") }}" class="nav-link {{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-comment-alt">

                            </i>
                            <p>
                                {{ trans('cruds.testimonial.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('trainer_setting_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.trainer-settings.index") }}" class="nav-link {{ request()->is("admin/trainer-settings") || request()->is("admin/trainer-settings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.trainerSetting.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('cycle_setting_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.cycle-settings.index") }}" class="nav-link {{ request()->is("admin/cycle-settings") || request()->is("admin/cycle-settings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.cycleSetting.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>