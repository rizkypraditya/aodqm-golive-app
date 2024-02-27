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
        Schema::create('revision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable();
            $table->foreignId('report_id')->nullable();
            $table->foreignId('mitra_id')->nullable();
            $table->string('status')->nullable();
            $table->text('note_revision')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision');
    }
};
