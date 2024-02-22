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
        Schema::create('tim1uin_record', function (Blueprint $table) {
            $table->bigIncrements('id_record');
            $table->string('modifed_by', 100)->nullabel();
            $table->date('submit_date', )->nullable();
            $table->string('note', 200)->nullable();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim1uin_record');
    }
};
