<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->longText('biography')->nullable()->after('about_team');
            $table->text('qualifications')->nullable()->after('biography');
            $table->text('practice_areas_text')->nullable()->after('qualifications');
            $table->text('courts_represented')->nullable()->after('practice_areas_text');
            $table->text('languages_spoken')->nullable()->after('courts_represented');
            $table->text('profile_summary')->nullable()->after('languages_spoken');
        });

        Schema::table('practice_areas', function (Blueprint $table) {
            $table->longText('issue_overview')->nullable()->after('description');
            $table->longText('legal_position')->nullable()->after('issue_overview');
            $table->longText('remedies')->nullable()->after('legal_position');
            $table->longText('documents_required')->nullable()->after('remedies');
            $table->longText('process_overview')->nullable()->after('documents_required');
            $table->longText('when_to_consult_lawyer')->nullable()->after('process_overview');
            $table->json('faq_items')->nullable()->after('when_to_consult_lawyer');
        });
    }

    public function down(): void
    {
        Schema::table('practice_areas', function (Blueprint $table) {
            $table->dropColumn([
                'issue_overview',
                'legal_position',
                'remedies',
                'documents_required',
                'process_overview',
                'when_to_consult_lawyer',
                'faq_items',
            ]);
        });

        Schema::table('attorneys', function (Blueprint $table) {
            $table->dropColumn([
                'biography',
                'qualifications',
                'practice_areas_text',
                'courts_represented',
                'languages_spoken',
                'profile_summary',
            ]);
        });
    }
};
