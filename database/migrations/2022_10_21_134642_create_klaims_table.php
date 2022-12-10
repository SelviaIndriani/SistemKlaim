<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klaims', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('customer_id');
            $table->string('customer_nama');
            $table->string('customer_alamat');
            $table->string('product_id');
            $table->string('product_nama');
            $table->string('product_ukuran');
            $table->string('damage_id');
            $table->string('checking_by');
            $table->double('mm_awal');
            $table->double('mm_akhir');
            $table->integer('no_seri');
            $table->integer('tahun_produksi');
            $table->string('keterangan_klaim');
            $table->string('hasil_klaim');
            $table->double('kompensasi')->nullable();
            $table->integer('hasil_pabrik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klaims');
    }
};
