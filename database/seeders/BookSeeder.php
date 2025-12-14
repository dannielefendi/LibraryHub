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
                'categories' => [3], // Technology
                'stock' => 5,
                'synopsis'=> 'In a small forgotten town, a mysterious library appears only at midnight. When a curious teenager named Elara enters the library, she discovers that every book contains the untold stories and secrets of the townspeople.',
                'admin_id' => 1
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'year' => '2021',
                'categories' => [5], // History
                'stock' => 3,
                'synopsis' => 'After a global communication blackout, a young engineer named Ryan receives a strange signal from an unknown location. With the world isolated and information scarce, Ryan begins a dangerous journey to uncover the source of the signal.',
                'admin_id' => 1
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'year' => '2022',
                'categories' => [3], // Technology
                'stock' => 4,
                'synopsis'=> 'In a small forgotten town, a mysterious library appears only at midnight. When a curious teenager named Elara enters the library, she discovers that every book contains the untold stories and secrets of the townspeople.',
                'admin_id' => 1
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'year' => '2020',
                'categories' => [4], // Education
                'stock' => 6,
                'synopsis' => 'After a global communication blackout, a young engineer named Ryan receives a strange signal from an unknown location. With the world isolated and information scarce, Ryan begins a dangerous journey to uncover the source of the signal.',
                'admin_id' => 1
            ],
        ];

        foreach ($books as $bookData) {
            $categories = $bookData['categories'];
            unset($bookData['categories']);
            $book = Book::updateOrCreate(['title' => $bookData['title']], $bookData);
            $book->categories()->sync($categories);
        }
    }
}
