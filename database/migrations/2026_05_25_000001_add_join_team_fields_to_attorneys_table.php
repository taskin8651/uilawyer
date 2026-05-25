<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJoinTeamFieldsToAttorneysTable extends Migration
{
    public function up()
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->string('place_of_practice')->nullable()->after('designation');
            $table->string('experience')->nullable()->after('place_of_practice');
            $table->text('address')->nullable()->after('experience');
            $table->string('phone')->nullable()->after('address');
            $table->string('email')->nullable()->after('phone');
            $table->text('about_team')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->dropColumn([
                'place_of_practice',
                'experience',
                'address',
                'phone',
                'email',
                'about_team',
            ]);
        });
    }
}
