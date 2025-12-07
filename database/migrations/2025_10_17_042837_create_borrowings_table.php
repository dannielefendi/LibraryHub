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
            $table->dateTime('due_date')->nullable();
            $table->integer('late_days')->nullable();

            // Status peminjaman
            // Borrowed = Buku dipinjem
            // Returned = Buku Dikembalikan
            // Late = Buku Melewati due date
            // Unavailable = Tidak bisa meminjam buku
            $table->enum('status', ['Borrowed','Returned', 'Late', 'Unavailable'])->default('Borrowed');

            // Denda
            $table->bigInteger('fine_total')->nullable();
            $table->bigInteger('fine_remaining')->nullable();

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
