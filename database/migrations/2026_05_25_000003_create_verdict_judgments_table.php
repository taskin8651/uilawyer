<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerdictJudgmentsTable extends Migration
{
    public function up()
    {
        Schema::create('verdict_judgments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('court_name')->nullable();
            $table->string('case_number')->nullable();
            $table->string('citation')->nullable();
            $table->string('author_name')->nullable();
            $table->date('judgment_date')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('result_summary')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $permissions = [
            'verdict_judgment_create',
            'verdict_judgment_edit',
            'verdict_judgment_show',
            'verdict_judgment_delete',
            'verdict_judgment_access',
        ];

        foreach ($permissions as $title) {
            $permission = Permission::firstOrCreate(['title' => $title]);

            if ($admin = Role::find(1)) {
                $admin->permissions()->syncWithoutDetaching($permission->id);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('verdict_judgments');

        Permission::whereIn('title', [
            'verdict_judgment_create',
            'verdict_judgment_edit',
            'verdict_judgment_show',
            'verdict_judgment_delete',
            'verdict_judgment_access',
        ])->delete();
    }
}
