<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Borrowing;
use Carbon\Carbon;
use App\Models\Book;


class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = Carbon::now();
        $bookIds = Book::pluck('id')->toArray();

        Borrowing::insert( [
            
            [
                'user_id' => 2,
                'book_id' => $bookIds[array_rand($bookIds)],
                'borrow_date' => $today->copy()->subDays(5),
                'due_date' => $today->copy()->addDays(9),
                'return_date' => null,
                'late_days' => 0,
                'status' => 'Borrowed',
                'fine_total' => 0,
                'fine_remaining' => 0,
                'admin_note' => 'Masih dalam masa pinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            [
                'user_id' => 2,
                'book_id' => $bookIds[array_rand($bookIds)],
                'borrow_date' => $today->copy()->subDays(20),
                'due_date' => $today->copy()->subDays(17),
                'return_date' => null,
                'late_days' => 3,
                'status' => 'Late',
                'fine_total' => 3 * 2000,
                'fine_remaining' => 3 * 2000,
                'admin_note' => 'Telat 3 hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            [
                'user_id' => 2,
                'book_id' => $bookIds[array_rand($bookIds)],
                'borrow_date' => $today->copy()->subDays(25),
                'due_date' => $today->copy()->subDays(19),
                'return_date' => null,
                'late_days' => 6,
                'status' => 'Late',
                'fine_total' => 6 * 2000,
                'fine_remaining' => 6 * 2000,
                'admin_note' => 'Telat 6 hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            [
                'user_id' => 2,
                'book_id' => $bookIds[array_rand($bookIds)],
                'borrow_date' => $today->copy()->subDays(10),
                'due_date' => $today->copy()->subDays(3),
                'return_date' => $today->copy()->subDays(3),
                'late_days' => 0,
                'status' => 'Returned',
                'fine_total' => 0,
                'fine_remaining' => 0,
                'admin_note' => 'Dikembalikan tepat waktu',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            [
                'user_id' => 2,
                'book_id' => $bookIds[array_rand($bookIds)],
                'borrow_date' => $today->copy()->subDays(22),
                'due_date' => $today->copy()->subDays(17),
                'return_date' => $today->copy()->subDays(12),
                'late_days' => 5,
                'status' => 'Returned',
                'fine_total' => 5 * 2000,
                'fine_remaining' => 5 * 2000,
                'admin_note' => 'Dikembalikan telat 5 hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
