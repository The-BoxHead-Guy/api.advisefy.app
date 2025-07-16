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
        if (!Schema::hasTable('pieces_of_advice')) {
            Schema::create('pieces_of_advices', function (Blueprint $table) {
                $table->id()->primary(true);
                $table->string('author')->default('Unknown');
                $table->string('text');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces_of_advices');
    }
};
