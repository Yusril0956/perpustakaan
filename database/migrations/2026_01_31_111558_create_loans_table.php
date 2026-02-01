<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->date('booking_date'); // Tanggal member pesan di web
            $table->date('loan_date')->nullable(); // Tanggal admin approve & buku diambil
            $table->date('due_date')->nullable(); // Tanggal harus kembali
            $table->date('return_date')->nullable(); // Tanggal aktual kembali
            $table->integer('daily_fine_fee')->default(2000); // Simpan tarif denda
            $table->enum('status', ['pending', 'active', 'returned', 'overdue', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
