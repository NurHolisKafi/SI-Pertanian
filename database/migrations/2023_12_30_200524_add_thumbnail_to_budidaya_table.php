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
        Schema::table('budidaya', function (Blueprint $table) {
            $table->string('thumbnail', 50)->after('tahapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budidaya', function (Blueprint $table) {
            $table->dropIfExists('thumbnail');
        });
    }
};
