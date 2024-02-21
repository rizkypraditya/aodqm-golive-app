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
        Schema::create('report', function (Blueprint $table) {
            $table->bigIncrements('id_report'); // Mengubah menjadi bigIncrements dengan nama 'id_report'
            $table->string('users')->unique();
            $table->string('nama_project')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('xml')->nullable();
            $table->string('maincord')->nullable();
            $table->string('abd')->nullable();
            $table->string('valins')->nullable();
            $table->date('submit_date')->nullable();
            $table->string('approver')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report'); // Mengubah nama tabel yang dihapus menjadi 'report'
    }
};


