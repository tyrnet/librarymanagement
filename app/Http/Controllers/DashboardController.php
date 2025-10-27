<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalBooks = Book::count();
            $totalCategories = Category::count();
            $totalQuantity = Book::sum('quantity') ?? 0;
            $totalValue = Book::sum('price') ?? 0;
            
            $recentBooks = Book::with('category')
                ->latest()
                ->limit(5)
                ->get();
                
            $categoriesWithCount = Category::withCount('books')
                ->orderBy('books_count', 'desc')
                ->limit(8)
                ->get();

            return view('dashboard', compact(
                'totalBooks',
                'totalCategories', 
                'totalQuantity',
                'totalValue',
                'recentBooks',
                'categoriesWithCount'
            ));
        } catch (\Exception $e) {
            // Fallback values in case of any database issues
            return view('dashboard', [
                'totalBooks' => 0,
                'totalCategories' => 0,
                'totalQuantity' => 0,
                'totalValue' => 0,
                'recentBooks' => collect(),
                'categoriesWithCount' => collect()
            ]);
        }
    }
}
