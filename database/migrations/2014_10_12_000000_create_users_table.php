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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('name', 50);
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['laki - laki', 'perempuan']);
            $table->text('alamat');
            $table->string('password');
            // $table->string('profesi', 50)->nullable();
            // $table->string('organisasi_petani', 50)->nullable();
            $table->integer('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
