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
        Schema::create('detail_kebutuhan_tanam', function (Blueprint $table) {
            $table->id('id_detail_kebutuhan');
            $table->unsignedBigInteger('id_kebutuhan');
            $table->unsignedBigInteger('id_tanaman');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailkebutuhan');
    }
};
