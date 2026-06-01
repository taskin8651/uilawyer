<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('type')->default('info');
            $table->string('url')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('priority')->default('medium');
            $table->string('status')->default('pending');
            $table->date('due_date')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('city_state')->nullable();
            $table->string('college_university')->nullable();
            $table->string('course_year')->nullable();
            $table->string('internship_type')->nullable();
            $table->string('practice_area_interest')->nullable();
            $table->date('preferred_start_date')->nullable();
            $table->string('preferred_duration')->nullable();
            $table->longText('message')->nullable();
            $table->boolean('consent')->default(false);
            $table->string('status')->default('new');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('important_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('icon')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('legal_qas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->longText('question');
            $table->longText('answer')->nullable();
            $table->string('status')->default('answered');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('awareness_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_url');
            $table->string('thumbnail_image')->nullable();
            $table->text('short_description')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('page_key')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        if (Schema::hasTable('testimonials') && ! Schema::hasColumn('testimonials', 'approval_status')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->string('approval_status')->default('new')->after('status');
            });
        }

        $this->seedPermissions();
        $this->seedImportantLinks();
    }

    public function down(): void
    {
        if (Schema::hasTable('testimonials') && Schema::hasColumn('testimonials', 'approval_status')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropColumn('approval_status');
            });
        }

        Schema::dropIfExists('meta_tags');
        Schema::dropIfExists('awareness_videos');
        Schema::dropIfExists('legal_qas');
        Schema::dropIfExists('important_links');
        Schema::dropIfExists('internship_applications');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('admin_notifications');
    }

    private function seedPermissions(): void
    {
        $permissions = [
            'notification_access', 'notification_show', 'notification_edit', 'notification_delete',
            'task_access', 'task_create', 'task_edit', 'task_show', 'task_delete',
            'internship_access', 'internship_show', 'internship_edit', 'internship_delete',
            'important_link_access', 'important_link_create', 'important_link_edit', 'important_link_show', 'important_link_delete',
            'legal_qa_access', 'legal_qa_show', 'legal_qa_delete',
            'awareness_video_access', 'awareness_video_create', 'awareness_video_edit', 'awareness_video_show', 'awareness_video_delete',
            'meta_tag_access', 'meta_tag_create', 'meta_tag_edit', 'meta_tag_show', 'meta_tag_delete',
        ];

        foreach ($permissions as $title) {
            $permissionId = DB::table('permissions')->updateOrInsert(
                ['title' => $title],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $adminRoleId = DB::table('roles')->where('id', 1)->value('id');

        if ($adminRoleId) {
            $permissionIds = DB::table('permissions')->whereIn('title', $permissions)->pluck('id');

            foreach ($permissionIds as $permissionId) {
                DB::table('permission_role')->updateOrInsert([
                    'role_id' => $adminRoleId,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    }

    private function seedImportantLinks(): void
    {
        $links = [
            ['title' => 'PHC', 'url' => 'https://patnahighcourt.gov.in/', 'icon' => 'fas fa-landmark', 'sort_order' => 1],
            ['title' => 'eCourts', 'url' => 'https://ecourts.gov.in/', 'icon' => 'fas fa-scale-balanced', 'sort_order' => 2],
            ['title' => 'Consumer Links', 'url' => 'https://consumerhelpline.gov.in/', 'icon' => 'fas fa-users', 'sort_order' => 3],
        ];

        foreach ($links as $link) {
            DB::table('important_links')->updateOrInsert(
                ['title' => $link['title']],
                array_merge($link, ['status' => true, 'created_at' => now(), 'updated_at' => now()])
            );
        }
    }
};
