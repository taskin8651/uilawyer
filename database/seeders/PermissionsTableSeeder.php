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
            ['id' => 200, 'title' => 'notification_access'],
            ['id' => 201, 'title' => 'notification_show'],
            ['id' => 202, 'title' => 'notification_edit'],
            ['id' => 203, 'title' => 'notification_delete'],
            ['id' => 210, 'title' => 'task_access'],
            ['id' => 211, 'title' => 'task_create'],
            ['id' => 212, 'title' => 'task_edit'],
            ['id' => 213, 'title' => 'task_show'],
            ['id' => 214, 'title' => 'task_delete'],
            ['id' => 220, 'title' => 'internship_access'],
            ['id' => 221, 'title' => 'internship_show'],
            ['id' => 222, 'title' => 'internship_edit'],
            ['id' => 223, 'title' => 'internship_delete'],
            ['id' => 230, 'title' => 'important_link_access'],
            ['id' => 231, 'title' => 'important_link_create'],
            ['id' => 232, 'title' => 'important_link_edit'],
            ['id' => 233, 'title' => 'important_link_show'],
            ['id' => 234, 'title' => 'important_link_delete'],
            ['id' => 240, 'title' => 'legal_qa_access'],
            ['id' => 241, 'title' => 'legal_qa_show'],
            ['id' => 242, 'title' => 'legal_qa_delete'],
            ['id' => 250, 'title' => 'awareness_video_access'],
            ['id' => 251, 'title' => 'awareness_video_create'],
            ['id' => 252, 'title' => 'awareness_video_edit'],
            ['id' => 253, 'title' => 'awareness_video_show'],
            ['id' => 254, 'title' => 'awareness_video_delete'],
            ['id' => 260, 'title' => 'meta_tag_access'],
            ['id' => 261, 'title' => 'meta_tag_create'],
            ['id' => 262, 'title' => 'meta_tag_edit'],
            ['id' => 263, 'title' => 'meta_tag_show'],
            ['id' => 264, 'title' => 'meta_tag_delete'],
        ];

        Permission::insertOrIgnore($permissions);
    }
}
