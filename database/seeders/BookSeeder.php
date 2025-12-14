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
                'categories' => [1, 2],
                'stock' => 5,
                'synopsis' => 'A comprehensive guide to building web applications with the Laravel framework.',
                'image_cover' => 'book_covers/laravel-basics.jpg', // Path lengkap
                'admin_id' => 1
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'year' => '2021',
                'categories' => [22, 24],
                'stock' => 3,
                'synopsis' => 'An ancient Chinese military treatise dating from the Late Spring and Autumn Period.',
                'image_cover' => 'book_covers/art-of-war.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'year' => '2022',
                'categories' => [1, 5],
                'stock' => 4,
                'synopsis' => 'A handbook of agile software craftsmanship to write better, cleaner code.',
                'image_cover' => 'book_covers/clean-code.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'year' => '2020',
                'categories' => [24, 14],
                'stock' => 10,
                'synopsis' => 'An easy and proven way to build good habits and break bad ones.',
                'image_cover' => 'book_covers/atomic-habits.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'year' => '2022',
                'categories' => [1, 6],
                'stock' => 8,
                'synopsis' => 'The standard textbook for algorithms used in universities worldwide.',
                'image_cover' => 'book_covers/intro-to-algorithms.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'author' => 'Stuart Russell',
                'year' => '2021',
                'categories' => [3, 1],
                'stock' => 6,
                'synopsis' => 'The most comprehensive introduction to the theory and practice of AI.',
                'image_cover' => 'book_covers/ai-modern-approach.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Principles of Economics',
                'author' => 'N. Gregory Mankiw',
                'year' => '2020',
                'categories' => [8],
                'stock' => 12,
                'synopsis' => 'A classic textbook covering microeconomics and macroeconomics principles.',
                'image_cover' => 'book_covers/principles-of-economics.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'year' => '2011',
                'categories' => [14, 8],
                'stock' => 7,
                'synopsis' => 'Explains the two systems that drive the way we think: fast and emotional vs slow and logical.',
                'image_cover' => 'book_covers/thinking-fast-slow.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'year' => '2011',
                'categories' => [12, 9],
                'stock' => 9,
                'synopsis' => 'How constant innovation creates radically successful businesses.',
                'image_cover' => 'book_covers/the-lean-startup.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Research Design',
                'author' => 'John W. Creswell',
                'year' => '2018',
                'categories' => [20, 21],
                'stock' => 15,
                'synopsis' => 'Qualitative, Quantitative, and Mixed Methods Approaches for students.',
                'image_cover' => 'book_covers/research-design.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'year' => '2015',
                'categories' => [22, 19],
                'stock' => 11,
                'synopsis' => 'Explores how biology and history have defined us and enhanced our understanding of what it means to be human.',
                'image_cover' => 'book_covers/sapiens.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'The Design of Everyday Things',
                'author' => 'Don Norman',
                'year' => '2013',
                'categories' => [17, 14],
                'stock' => 5,
                'synopsis' => 'The fundamental principles of great design and usability.',
                'image_cover' => 'book_covers/design-everyday-things.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'The Rule of Law',
                'author' => 'Tom Bingham',
                'year' => '2010',
                'categories' => [16],
                'stock' => 4,
                'synopsis' => 'A brilliant explanation of what the rule of law is and why it matters.',
                'image_cover' => 'book_covers/rule-of-law.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Financial Intelligence',
                'author' => 'Karen Berman',
                'year' => '2013',
                'categories' => [11, 13],
                'stock' => 8,
                'synopsis' => 'A manager\'s guide to knowing what the numbers really mean.',
                'image_cover' => 'book_covers/financial-intelligence.jpg',
                'admin_id' => 1
            ],
            [
                'title' => 'Calculus: Early Transcendentals',
                'author' => 'James Stewart',
                'year' => '2020',
                'categories' => [6, 5],
                'stock' => 20,
                'synopsis' => 'The most successful calculus textbook for engineering and science students.',
                'image_cover' => 'book_covers/calculus.jpg',
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