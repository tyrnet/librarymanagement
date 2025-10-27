@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="cyber-dashboard-header mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="cyber-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
            <p class="cyber-subtitle mb-0">Welcome to your Library Management System</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="cyber-date">
                <i class="fas fa-calendar-alt"></i>
                <span id="current-date">{{ now()->format('l, F j, Y') }}</span>
            </div>
            <div class="cyber-time mt-2">
                <i class="fas fa-clock"></i>
                <span id="current-time">{{ now()->format('h:i:s A') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5">
    <div class="col-md-3 mb-4">
        <div class="card cyber-stats-card cyber-stats-card--cyan">
            <div class="card-body">
                <div class="cyber-stats-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="cyber-stats-number">{{ $totalBooks }}</div>
                <div class="cyber-stats-label">Total Books</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card cyber-stats-card cyber-stats-card--green">
            <div class="card-body">
                <div class="cyber-stats-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="cyber-stats-number">{{ $totalCategories }}</div>
                <div class="cyber-stats-label">Categories</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card cyber-stats-card cyber-stats-card--yellow">
            <div class="card-body">
                <div class="cyber-stats-icon">
                    <i class="fas fa-cubes"></i>
                </div>
                <div class="cyber-stats-number">{{ $totalQuantity }}</div>
                <div class="cyber-stats-label">Total Quantity</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card cyber-stats-card cyber-stats-card--pink">
            <div class="card-body">
                <div class="cyber-stats-icon">
                    <i class="fas fa-peso-sign"></i>
                </div>
                <div class="cyber-stats-number">₱{{ number_format($totalValue, 2) }}</div>
                <div class="cyber-stats-label">Total Value</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card cyber-actions-card">
            <div class="card-header">
                <h5 class="cyber-card-title"><i class="fas fa-bolt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('books.create') }}" class="btn btn-primary w-100 cyber-action-btn">
                            <i class="fas fa-plus"></i>
                            <span>Add New Book</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-success w-100 cyber-action-btn">
                            <i class="fas fa-tag"></i>
                            <span>Add Category</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('books.index') }}" class="btn btn-info w-100 cyber-action-btn">
                            <i class="fas fa-list"></i>
                            <span>View All Books</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-warning w-100 cyber-action-btn">
                            <i class="fas fa-th-large"></i>
                            <span>View Categories</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Books & Categories -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-clock"></i> Recent Books</h5>
                <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
            </div>
            <div class="card-body">
                @if($recentBooks->count() > 0)
                    <div class="recent-books">
                        @foreach($recentBooks as $book)
                            <div class="recent-book-item">
                                <div class="book-info">
                                    <h6 class="book-title">{{ $book->title }}</h6>
                                    <p class="book-author text-muted">{{ $book->author }}</p>
                                    <span class="badge bg-primary">{{ $book->category->name }}</span>
                                </div>
                                <div class="book-actions">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-book"></i>
                        <h6>No books yet</h6>
                        <p>Start by adding your first book!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-pie"></i> Categories Overview</h5>
            </div>
            <div class="card-body">
                @if($categoriesWithCount->count() > 0)
                    <div class="categories-overview">
                        @foreach($categoriesWithCount as $category)
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name">{{ $category->name }}</span>
                                    <span class="category-count">{{ $category->books_count }} books</span>
                                </div>
                                <div class="category-bar">
                                    <div class="category-progress" style="width: {{ $category->books_count > 0 ? ($category->books_count / $categoriesWithCount->max('books_count')) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-tags"></i>
                        <h6>No categories yet</h6>
                        <p>Create your first category!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateDateTime() {
        const now = new Date();
        
        // Format date
        const dateOptions = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };
        const formattedDate = now.toLocaleDateString('en-US', dateOptions);
        
        // Format time
        const timeOptions = { 
            hour: 'numeric', 
            minute: '2-digit', 
            second: '2-digit',
            hour12: true 
        };
        const formattedTime = now.toLocaleTimeString('en-US', timeOptions);
        
        // Update the elements
        const dateElement = document.getElementById('current-date');
        const timeElement = document.getElementById('current-time');
        
        if (dateElement) {
            dateElement.textContent = formattedDate;
        }
        if (timeElement) {
            timeElement.textContent = formattedTime;
        }
    }
    
    // Update immediately
    updateDateTime();
    
    // Update every second
    setInterval(updateDateTime, 1000);
});
</script>
@endsection
