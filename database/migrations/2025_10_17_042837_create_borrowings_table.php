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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();

            // Relasi ke user dan book
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');

            // Tanggal peminjaman dan pengembalian
            $table->date('borrow_date')->nullable();
            $table->date('return_date')->nullable();

            // Status peminjaman
            // Pending = menunggu approval admin
            // Dipinjam = sudah disetujui admin
            // Dikembalikan = buku sudah dikembalikan
            // Ditolak = permintaan peminjaman ditolak admin
            $table->enum('status', ['Pending', 'Borrowed', 'Returned', 'Rejected'])->default('Pending');

            // Kolom tambahan opsional untuk catatan admin
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
