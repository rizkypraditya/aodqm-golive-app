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
        Schema::table('tim1uin_record', function (Blueprint $table) {
            $table->unsignedBigInteger('id_report')->after('user_id');
            $table->foreign('id_report')->references('id_report')->on('tim1uin_report');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tim1uin_record', function (Blueprint $table) {
            $table->dropColumn('id_report');
        });
    }
};
