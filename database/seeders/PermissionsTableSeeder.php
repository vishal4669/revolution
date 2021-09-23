<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'cycle_module_access',
            ],
            [
                'id'    => 18,
                'title' => 'cycle_create',
            ],
            [
                'id'    => 19,
                'title' => 'cycle_edit',
            ],
            [
                'id'    => 20,
                'title' => 'cycle_show',
            ],
            [
                'id'    => 21,
                'title' => 'cycle_delete',
            ],
            [
                'id'    => 22,
                'title' => 'cycle_access',
            ],
            [
                'id'    => 23,
                'title' => 'renting_cycle_create',
            ],
            [
                'id'    => 24,
                'title' => 'renting_cycle_edit',
            ],
            [
                'id'    => 25,
                'title' => 'renting_cycle_show',
            ],
            [
                'id'    => 26,
                'title' => 'renting_cycle_delete',
            ],
            [
                'id'    => 27,
                'title' => 'renting_cycle_access',
            ],
            [
                'id'    => 28,
                'title' => 'cycle_expense_create',
            ],
            [
                'id'    => 29,
                'title' => 'cycle_expense_edit',
            ],
            [
                'id'    => 30,
                'title' => 'cycle_expense_show',
            ],
            [
                'id'    => 31,
                'title' => 'cycle_expense_delete',
            ],
            [
                'id'    => 32,
                'title' => 'cycle_expense_access',
            ],
            [
                'id'    => 33,
                'title' => 'events_module_access',
            ],
            [
                'id'    => 34,
                'title' => 'event_create',
            ],
            [
                'id'    => 35,
                'title' => 'event_edit',
            ],
            [
                'id'    => 36,
                'title' => 'event_show',
            ],
            [
                'id'    => 37,
                'title' => 'event_delete',
            ],
            [
                'id'    => 38,
                'title' => 'event_access',
            ],
            [
                'id'    => 39,
                'title' => 'ticket_create',
            ],
            [
                'id'    => 40,
                'title' => 'ticket_edit',
            ],
            [
                'id'    => 41,
                'title' => 'ticket_show',
            ],
            [
                'id'    => 42,
                'title' => 'ticket_delete',
            ],
            [
                'id'    => 43,
                'title' => 'ticket_access',
            ],
            [
                'id'    => 44,
                'title' => 'event_registration_create',
            ],
            [
                'id'    => 45,
                'title' => 'event_registration_edit',
            ],
            [
                'id'    => 46,
                'title' => 'event_registration_show',
            ],
            [
                'id'    => 47,
                'title' => 'event_registration_delete',
            ],
            [
                'id'    => 48,
                'title' => 'event_registration_access',
            ],
            [
                'id'    => 49,
                'title' => 'trainer_module_access',
            ],
            [
                'id'    => 50,
                'title' => 'trainer_create',
            ],
            [
                'id'    => 51,
                'title' => 'trainer_edit',
            ],
            [
                'id'    => 52,
                'title' => 'trainer_show',
            ],
            [
                'id'    => 53,
                'title' => 'trainer_delete',
            ],
            [
                'id'    => 54,
                'title' => 'trainer_access',
            ],
            [
                'id'    => 55,
                'title' => 'renting_trainer_create',
            ],
            [
                'id'    => 56,
                'title' => 'renting_trainer_edit',
            ],
            [
                'id'    => 57,
                'title' => 'renting_trainer_show',
            ],
            [
                'id'    => 58,
                'title' => 'renting_trainer_delete',
            ],
            [
                'id'    => 59,
                'title' => 'renting_trainer_access',
            ],
            [
                'id'    => 60,
                'title' => 'trainer_expense_create',
            ],
            [
                'id'    => 61,
                'title' => 'trainer_expense_edit',
            ],
            [
                'id'    => 62,
                'title' => 'trainer_expense_show',
            ],
            [
                'id'    => 63,
                'title' => 'trainer_expense_delete',
            ],
            [
                'id'    => 64,
                'title' => 'trainer_expense_access',
            ],
            [
                'id'    => 65,
                'title' => 'brand_create',
            ],
            [
                'id'    => 66,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 67,
                'title' => 'brand_show',
            ],
            [
                'id'    => 68,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 69,
                'title' => 'brand_access',
            ],
            [
                'id'    => 70,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 71,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 72,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 73,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 74,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 75,
                'title' => 'trainer_setting_create',
            ],
            [
                'id'    => 76,
                'title' => 'trainer_setting_edit',
            ],
            [
                'id'    => 77,
                'title' => 'trainer_setting_show',
            ],
            [
                'id'    => 78,
                'title' => 'trainer_setting_delete',
            ],
            [
                'id'    => 79,
                'title' => 'trainer_setting_access',
            ],
            [
                'id'    => 80,
                'title' => 'cycle_setting_create',
            ],
            [
                'id'    => 81,
                'title' => 'cycle_setting_edit',
            ],
            [
                'id'    => 82,
                'title' => 'cycle_setting_show',
            ],
            [
                'id'    => 83,
                'title' => 'cycle_setting_delete',
            ],
            [
                'id'    => 84,
                'title' => 'cycle_setting_access',
            ],
            [
                'id'    => 85,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
