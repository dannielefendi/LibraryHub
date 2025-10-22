<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laravel Basics',
                'author' => 'Taylor Otwell',
                'year' => '2023',
                'category_id' => 3, // Technology
                'stock' => 5,
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'year' => '2021',
                'category_id' => 5, // History
                'stock' => 3,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(['title' => $book['title']], $book);
        }
    }
}
