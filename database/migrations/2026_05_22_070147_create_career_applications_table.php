<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();

            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city_state')->nullable();

            $table->string('college_university')->nullable();
            $table->string('course_year')->nullable();

            $table->string('internship_type')->nullable();
            $table->string('practice_area_interest')->nullable();

            $table->date('preferred_start_date')->nullable();
            $table->string('preferred_duration')->nullable();

            $table->longText('message')->nullable();

            $table->boolean('consent')->default(0);
            $table->string('status')->default('new'); // new / reviewed / shortlisted / rejected

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_applications');
    }
}