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
        Schema::table('tim1uin_report', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id_report');
            $table->foreign('user_id')->references('id')->on('tim1uin_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tim1uin_report', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
