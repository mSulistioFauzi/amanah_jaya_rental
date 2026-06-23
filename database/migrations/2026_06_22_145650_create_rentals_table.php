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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('car_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');

            $table->integer('lama_sewa');

            $table->decimal('total_harga', 12, 2);

            $table->enum('status', [
                'pending',
                'disetujui',
                'ditolak',
                'selesai'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
