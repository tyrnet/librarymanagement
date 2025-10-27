<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Novels, short stories, and other fictional works'
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Biographies, history, science, and other factual works'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Speculative fiction dealing with futuristic concepts'
            ],
            [
                'name' => 'Mystery',
                'description' => 'Detective stories and crime fiction'
            ],
            [
                'name' => 'Romance',
                'description' => 'Love stories and romantic fiction'
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Fantasy novels with magical elements and imaginary worlds'
            ],
            [
                'name' => 'Thriller',
                'description' => 'Suspenseful stories designed to keep readers on edge'
            ],
            [
                'name' => 'Horror',
                'description' => 'Stories intended to frighten, unsettle, or create suspense'
            ],
            [
                'name' => 'Biography',
                'description' => 'Detailed accounts of a person\'s life written by another person'
            ],
            [
                'name' => 'History',
                'description' => 'Books about past events, particularly in human affairs'
            ],
            [
                'name' => 'Self-Help',
                'description' => 'Books designed to help readers solve personal problems'
            ],
            [
                'name' => 'Business',
                'description' => 'Books about business management, entrepreneurship, and economics'
            ],
            [
                'name' => 'Technology',
                'description' => 'Books about computers, programming, and technological advances'
            ],
            [
                'name' => 'Health & Fitness',
                'description' => 'Books about physical and mental health, exercise, and wellness'
            ],
            [
                'name' => 'Travel',
                'description' => 'Books about travel experiences, guides, and destinations'
            ],
            [
                'name' => 'Cooking',
                'description' => 'Cookbooks and culinary guides'
            ],
            [
                'name' => 'Art & Design',
                'description' => 'Books about visual arts, design principles, and creative techniques'
            ],
            [
                'name' => 'Philosophy',
                'description' => 'Books exploring fundamental questions about existence, knowledge, and ethics'
            ],
            [
                'name' => 'Religion & Spirituality',
                'description' => 'Books about religious beliefs, spiritual practices, and faith'
            ],
            [
                'name' => 'Children\'s Books',
                'description' => 'Books specifically written for children and young readers'
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create books
        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '978-0-06-112008-4',
                'description' => 'A gripping tale of racial injustice and childhood innocence in the American South.',
                'quantity' => 5,
                'price' => 650.00,
                'category_id' => 1
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '978-0-452-28423-4',
                'description' => 'A dystopian social science fiction novel about totalitarian control.',
                'quantity' => 3,
                'price' => 750.00,
                'category_id' => 3
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '978-0-7432-7356-5',
                'description' => 'A story of the fabulously wealthy Jay Gatsby and his love for Daisy Buchanan.',
                'quantity' => 4,
                'price' => 600.00,
                'category_id' => 1
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-0-06-231609-7',
                'description' => 'A brief history of humankind from the Stone Age to the present.',
                'quantity' => 2,
                'price' => 850.00,
                'category_id' => 2
            ],
            [
                'title' => 'The Murder of Roger Ackroyd',
                'author' => 'Agatha Christie',
                'isbn' => '978-0-06-207420-3',
                'description' => 'A classic mystery novel featuring Hercule Poirot.',
                'quantity' => 6,
                'price' => 700.00,
                'category_id' => 4
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'isbn' => '978-0-14-143951-8',
                'description' => 'A romantic novel about Elizabeth Bennet and Mr. Darcy.',
                'quantity' => 7,
                'price' => 550.00,
                'category_id' => 5
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'isbn' => '978-0-547-92822-7',
                'description' => 'An epic high-fantasy novel about the quest to destroy the One Ring.',
                'quantity' => 4,
                'price' => 1200.00,
                'category_id' => 6
            ],
            [
                'title' => 'The Girl with the Dragon Tattoo',
                'author' => 'Stieg Larsson',
                'isbn' => '978-0-307-26975-1',
                'description' => 'A psychological thriller about a journalist and a hacker.',
                'quantity' => 3,
                'price' => 800.00,
                'category_id' => 7
            ],
            [
                'title' => 'The Shining',
                'author' => 'Stephen King',
                'isbn' => '978-0-385-12167-5',
                'description' => 'A horror novel about a family\'s stay at an isolated hotel.',
                'quantity' => 5,
                'price' => 750.00,
                'category_id' => 8
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'isbn' => '978-1-4516-4853-9',
                'description' => 'The exclusive biography of the Apple co-founder.',
                'quantity' => 3,
                'price' => 900.00,
                'category_id' => 9
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '978-0-553-38016-3',
                'description' => 'A popular science book about cosmology and theoretical physics.',
                'quantity' => 4,
                'price' => 850.00,
                'category_id' => 2
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen Covey',
                'isbn' => '978-1-982137-27-2',
                'description' => 'A business and self-help book about personal and professional effectiveness.',
                'quantity' => 6,
                'price' => 700.00,
                'category_id' => 11
            ]
        ];

        foreach ($books as $bookData) {
            Book::create($bookData);
        }
    }
}