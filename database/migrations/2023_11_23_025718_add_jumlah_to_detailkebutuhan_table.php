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
        Schema::table('detail_kebutuhan_tanam', function (Blueprint $table) {
            $table->unsignedInteger('jumlah')->default(1);
            $table->unsignedBigInteger('id_luas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_kebutuhan_tanam', function (Blueprint $table) {
            //
            $table->dropColumn('jumlah');
            $table->dropColumn('id_luas');
        });
    }
};
