<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('legal_enquiries', function (Blueprint $table) {
            $table->id();

            $table->string('form_type')->nullable(); // consultation / contact

            $table->string('full_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('case_category')->nullable();
            $table->string('city_state')->nullable();

            $table->string('preferred_contact_mode')->nullable();
            $table->date('preferred_date')->nullable();
            $table->time('preferred_time')->nullable();

            $table->longText('case_message')->nullable();

            $table->boolean('consent')->default(0);
            $table->string('status')->default('new'); // new / contacted / closed

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('legal_enquiries');
    }
}