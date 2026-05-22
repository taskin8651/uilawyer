<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailFieldsToPracticeAreaServicesTable extends Migration
{
    public function up()
    {
        Schema::table('practice_area_services', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('short_description');
            $table->string('meta_title')->nullable()->after('sort_order');
            $table->longText('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });
    }

    public function down()
    {
        Schema::table('practice_area_services', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'meta_title',
                'meta_description',
                'meta_keywords',
            ]);
        });
    }
}
