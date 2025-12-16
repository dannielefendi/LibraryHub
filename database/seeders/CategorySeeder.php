<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // IT & Engineering
            'Computer Science',
            'Web Development',
            'Data Science & AI',
            'Cybersecurity',
            'Engineering',
            'Mathematics',
            'Technology',

            // Business & Economics
            'Economics',
            'Management',
            'Marketing',
            'Accounting',
            'Entrepreneurship',
            'Business', 

            // Social, Law & Humanities
            'Psychology',
            'Communication',
            'Law',
            'Art & Design',
            'International Relations',
            'Social & Humanities',

            // General Education & Research
            'Academic Research', 
            'Education',
            'History',
            'Philosophy',
            'Self-Development',
            'Language & Literature'
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category]);
        }
    }
}