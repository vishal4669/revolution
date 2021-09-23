<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'fname'                    => 'First Name',
            'fname_helper'             => 'Enter first name',
            'lname'                    => 'Last Name',
            'lname_helper'             => ' ',
            'mobile'                   => 'Mobile',
            'mobile_helper'            => 'Enter 10 digit mobile number',
            'add_1'                    => 'Address Line 1',
            'add_1_helper'             => 'Enter your address',
            'add_2'                    => 'Address line 2',
            'add_2_helper'             => ' ',
            'city'                     => 'City',
            'city_helper'              => 'Enter city',
            'state'                    => 'State',
            'state_helper'             => 'Enter State',
            'pincode'                  => 'Pincode',
            'pincode_helper'           => 'Enter pincode',
            'username'                 => 'Username',
            'username_helper'          => 'Enter username',
            'image'                    => 'Image',
            'image_helper'             => 'Upload a image of user',
        ],
    ],
    'cycleModule' => [
        'title'          => 'Cycle Module',
        'title_singular' => 'Cycle Module',
    ],
    'cycle' => [
        'title'          => 'Cycle',
        'title_singular' => 'Cycle',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => 'Enter Cycle Name (Brand and Model)',
            'photo'                => 'Photo',
            'photo_helper'         => 'Upload photos of cycle',
            'description'          => 'Description',
            'description_helper'   => 'Enter Description of Cycle. (Size, Gear Set, etc...)',
            'cycle_cost'          => 'Cycle Cost',
            'cycle_cost_helper'   => 'Enter Cost of Cycle',
            'type'                 => 'Type',
            'type_helper'          => 'Select type of Cycle',
            'serial_number'        => 'Serial Number',
            'serial_number_helper' => 'Enter Serial Number of Cycle',
            'rent_month'           => 'Rent Per Month',
            'rent_month_helper'    => 'Enter Monthly rent for cycle',
            'rent_hour'            => 'Rent Per Hour',
            'rent_hour_helper'     => 'Enter Hourly rent for cycle',
            'is_active'            => 'Is Active?',
            'is_active_helper'     => ' ',
            'is_rented'            => 'Is Rented',
            'is_rented_helper'     => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'rentingCycle' => [
        'title'          => 'Renting Cycle',
        'title_singular' => 'Renting Cycle',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'cycle'                   => 'Cycle',
            'cycle_helper'            => 'Select cycle to Rent',
            'user'                    => 'User',
            'user_helper'             => ' ',
            'booking_type'            => 'Booking Type',
            'booking_type_helper'     => ' ',
            'total_hours'             => 'Total Hours',
            'total_hours_helper'      => ' ',
            'from_date'               => 'From Date',
            'from_date_helper'        => 'Enter cycle rent start date',
            'to_date'                 => 'To Date',
            'to_date_helper'          => 'Enter cycle rent end date',
            'total_days'              => 'Total Days',
            'total_days_helper'       => 'Calculated total days',
            'price_per_day'           => 'Price Per Day',
            'price_per_day_helper'    => 'Calculated price per day',
            'total_rent'              => 'Total Rent',
            'total_rent_helper'       => 'Total Rent Receivable (Calculated)',
            'deposit_received'        => 'Deposit Received',
            'deposit_received_helper' => 'Enter amount of Deposit Received',
            'payment_option'          => 'Payment Option',
            'payment_option_helper'   => ' ',
            'is_cancelled'            => 'Booking Cancelled',
            'is_cancelled_helper'     => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'cycleExpense' => [
        'title'          => 'Cycle Expenses',
        'title_singular' => 'Cycle Expense',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'repair_date'        => 'Repair Date',
            'repair_date_helper' => 'Enter Repair/Expense Date',
            'cycle'              => 'Cycle',
            'cycle_helper'       => 'Select Cycle that has been repaired',
            'amount'             => 'Amount',
            'amount_helper'      => 'Enter amount of expense incurred',
            'description'        => 'Description',
            'description_helper' => 'Enter additional details pertaining to repair/ expense.',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'eventsModule' => [
        'title'          => 'Events Module',
        'title_singular' => 'Events Module',
    ],
    'event' => [
        'title'          => 'Events',
        'title_singular' => 'Event',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => 'Enter Event Name',
            'event_images'             => 'Event Images',
            'event_images_helper'      => 'Enter Event Images',
            'description'              => 'Description',
            'description_helper'       => 'Enter Event Description',
            'last_booking_date'        => 'Last Booking Date',
            'last_booking_date_helper' => 'Select Last Booking Date',
            'event_start_day'          => 'Event Start Day',
            'event_start_day_helper'   => 'Select Event Start Date',
            'terms'                    => 'Event Terms',
            'terms_helper'             => 'Enter Event Terms',
            'location'                 => 'Location',
            'location_helper'          => 'Enter Event Location',
            'event_type'               => 'Event Type',
            'event_type_helper'        => ' ',
            'is_cancelled'             => 'Is Cancelled',
            'is_cancelled_helper'      => ' ',
            'is_active'                => 'Is Active',
            'is_active_helper'         => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'ticket' => [
        'title'          => 'Tickets',
        'title_singular' => 'Ticket',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'event'                 => 'Event',
            'event_helper'          => ' ',
            'ticket_name'           => 'Ticket Name',
            'ticket_name_helper'    => ' ',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'ticket_price'          => 'Ticket Price',
            'ticket_price_helper'   => ' ',
            'max_entries'           => 'Maximum no. of Entries',
            'max_entries_helper'    => ' ',
            'booked_tickets'        => 'Booked Tickets',
            'booked_tickets_helper' => ' ',
            'stop_booking'          => 'Stop Booking',
            'stop_booking_helper'   => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'eventRegistration' => [
        'title'          => 'Event Registration',
        'title_singular' => 'Event Registration',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'event'                  => 'Event',
            'event_helper'           => ' ',
            'payment_mode'           => 'Payment Mode',
            'payment_mode_helper'    => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'amount_received'        => 'Amount Received',
            'amount_received_helper' => ' ',
            'transaction'            => 'Transaction ID',
            'transaction_helper'     => ' ',
            'unique_reg_no'          => 'Unique Registration Number',
            'unique_reg_no_helper'   => ' ',
            'ticket'                 => 'Ticket',
            'ticket_helper'          => ' ',
        ],
    ],
'trainerModule' => [
        'title'          => 'Trainer Module',
        'title_singular' => 'Trainer Module',
    ],
    'trainer' => [
        'title'          => 'Trainers',
        'title_singular' => 'Trainer',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => 'Unique cycle name.',
            'photo'                => 'Photo',
            'photo_helper'         => ' ',
            'trainer_cost'         => 'Trainer Cost',
            'trainer_cost_helper'  => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'type'                 => 'Type',
            'type_helper'          => ' ',
            'serial_number'        => 'Serial Number',
            'serial_number_helper' => ' ',
            'rent_month'           => 'Rent Per Month',
            'rent_month_helper'    => 'Enter Monthly rent for cycle',
            'rent_hour'            => 'Rent Per Hour',
            'rent_hour_helper'     => ' ',
            'is_active'            => 'Is Active?',
            'is_active_helper'     => ' ',
            'is_rented'            => 'Is Rented',
            'is_rented_helper'     => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'rentingTrainer' => [
        'title'          => 'Renting Trainer',
        'title_singular' => 'Renting Trainer',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'trainer'                 => 'Trainer',
            'trainer_helper'          => 'Select trainer to Rent',
            'user'                    => 'User',
            'user_helper'             => ' ',
            'booking_type'            => 'Booking Type',
            'booking_type_helper'     => ' ',
            'total_hours'             => 'Total Hours',
            'total_hours_helper'      => ' ',
            'from_date'               => 'From Date',
            'from_date_helper'        => 'Enter cycle rent start date',
            'to_date'                 => 'To Date',
            'to_date_helper'          => 'Enter cycle rent end date',
            'total_days'              => 'Total Days',
            'total_days_helper'       => 'calculated total days',
            'price_per_day'           => 'Price Per Day',
            'price_per_day_helper'    => 'Calculated price per day',
            'total_rent'              => 'Total Rent',
            'total_rent_helper'       => 'Total Rent Receivable (Calculated)',
            'deposit_received'        => 'Deposit Received',
            'deposit_received_helper' => 'Enter amount of Deposit Received',
            'payment_option'          => 'Payment Option',
            'payment_option_helper'   => ' ',
            'is_cancelled'            => 'Booking Cancelled',
            'is_cancelled_helper'     => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'trainerExpense' => [
        'title'          => 'Trainer Expenses',
        'title_singular' => 'Trainer Expense',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'repair_date'        => 'Repair Date',
            'repair_date_helper' => 'Enter Repair/Expense Date',
            'trainer'            => 'Trainer',
            'trainer_helper'     => 'Select Trainer that has been repaired',
            'amount'             => 'Amount',
            'amount_helper'      => 'Enter amount of expense incurred',
            'description'        => 'Description',
            'description_helper' => 'Enter additional details pertaining to repair/ expense.',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'brand' => [
        'title'          => 'Brands',
        'title_singular' => 'Brand',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'logo'              => 'Logo',
            'logo_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'testimonial' => [
        'title'          => 'Testimonials',
        'title_singular' => 'Testimonial',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'user'               => 'User',
            'user_helper'        => ' ',
            'testimonial'        => 'Testimonial',
            'testimonial_helper' => ' ',
            'user_photo'         => 'User Photo',
            'user_photo_helper'  => ' ',
            'is_visible'         => 'Is Visible?',
            'is_visible_helper'  => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'trainerSetting' => [
        'title'          => 'Trainer Setting',
        'title_singular' => 'Trainer Setting',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'trainer'                   => 'Trainer',
            'trainer_helper'            => ' ',
            'rent_per_hour'             => 'Rent Per Hour',
            'rent_per_hour_helper'      => 'Enter rent per hour',
            'rent_per_day'              => 'Rent Per Day',
            'rent_per_day_helper'       => 'Enter rent per day',
            'rent_per_week'             => 'Rent Per Week',
            'rent_per_week_helper'      => ' ',
            'rent_per_fortnight'        => 'Rent Per Fortnight',
            'rent_per_fortnight_helper' => 'Enter rent per fortnight',
            'slot_booking_limit'        => 'Slot Booking Limit',
            'slot_booking_limit_helper' => ' ',
            'booking_amount'            => 'Booking Amount',
            'booking_amount_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'is_cafe_trainer'           => 'Is Cafe Trainer?',
            'is_cafe_trainer_helper'    => ' ',
        ],
    ],
    'cycleSetting' => [
        'title'          => 'Cycle Setting',
        'title_singular' => 'Cycle Setting',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'cycle'                     => 'Cycle',
            'cycle_helper'              => ' ',
            'rent_per_hour'             => 'Rent Per Hour',
            'rent_per_hour_helper'      => 'Enter rent per hour',
            'rent_per_day'              => 'Rent Per Day',
            'rent_per_day_helper'       => 'Enter rent per day',
            'rent_per_week'             => 'Rent Per Week',
            'rent_per_week_helper'      => ' ',
            'rent_per_fortnight'        => 'Rent Per Fortnight',
            'rent_per_fortnight_helper' => 'Enter rent per fortnight',
            'slot_booking_limit'        => 'Slot Booking Limit',
            'slot_booking_limit_helper' => ' ',
            'booking_amount'            => 'Booking Amount',
            'booking_amount_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
];
