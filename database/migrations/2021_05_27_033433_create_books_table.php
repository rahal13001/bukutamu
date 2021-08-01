<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('employes_id', false);
            $table->string('nama', 100);
            $table->string('instansi', 100);
            $table->string('no_hp', 30);
            $table->string('email', 100);
            $table->string('jk', 20);
            $table->date('tanggal');
            $table->time('datang');
            $table->time('pulang')->nullable();
            $table->string('suhu', false)->nullable();
            $table->string('keperluan', 255)->nullable();
            $table->string('lokasi', 50);
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
        Schema::dropIfExists('books');
    }
}
