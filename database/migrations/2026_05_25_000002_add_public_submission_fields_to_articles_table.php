<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublicSubmissionFieldsToArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('submitter_email')->nullable()->after('author_name');
            $table->string('submitter_phone')->nullable()->after('submitter_email');
            $table->boolean('is_public_submission')->default(0)->after('read_more_url');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'submitter_email',
                'submitter_phone',
                'is_public_submission',
            ]);
        });
    }
}
