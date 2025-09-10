<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('pieces_of_advices') && Schema::hasColumn('pieces_of_advices', 'text')) {
            Schema::table('pieces_of_advices', function (Blueprint $table) {
                $table->unique('text', 'pieces_of_advices_text_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pieces_of_advices') && Schema::hasColumn('pieces_of_advices', 'text')) {
            Schema::table('pieces_of_advices', function (Blueprint $table) {
                $table->dropUnique('pieces_of_advices_text_unique');
            });
        }
    }
};
