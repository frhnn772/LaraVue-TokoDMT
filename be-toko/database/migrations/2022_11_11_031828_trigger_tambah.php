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
        DB::unprepared('CREATE TRIGGER update_jumlah_pembeli BEFORE INSERT ON pembeli FOR EACH ROW 
	BEGIN UPDATE produk SET produk.jumlah_pembeli = produk.jumlah_pembeli + 1 WHERE produk.id_produk = new.id_produk; END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
