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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 24,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 100,
                'title' => 'practice_area_create',
            ],
            [
                'id'    => 101,
                'title' => 'practice_area_edit',
            ],
            [
                'id'    => 102,
                'title' => 'practice_area_show',
            ],
            [
                'id'    => 103,
                'title' => 'practice_area_delete',
            ],
            [
                'id'    => 104,
                'title' => 'practice_area_access',
            ],
            [
                'id'    => 105,
                'title' => 'practice_area_service_create',
            ],
            [
                'id'    => 106,
                'title' => 'practice_area_service_edit',
            ],
            [
                'id'    => 107,
                'title' => 'practice_area_service_show',
            ],
            [
                'id'    => 108,
                'title' => 'practice_area_service_delete',
            ],
            [
                'id'    => 109,
                'title' => 'practice_area_service_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
