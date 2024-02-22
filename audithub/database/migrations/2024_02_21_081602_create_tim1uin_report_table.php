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
        Schema::create('tim1uin_report', function (Blueprint $table) {
            $table->bigIncrements('id_report'); // Mengubah menjadi bigIncrements dengan nama 'id_report'
            $table->string('nama_project', 100)->require();
            $table->string('nama', 100)->require();
            $table->date('tanggal')->require();
            $table->string('xml')->require();
            $table->string('maincord')->require();
            $table->string('abd')->require();
            $table->string('valins')->require();
            $table->string('status', 100)->require();
            $table->date('submit_date')->require();
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


