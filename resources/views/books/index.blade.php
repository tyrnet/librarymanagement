@extends('layouts.app')

@section('title', 'Books')

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-book"></i> Books
    </li>
@endsection

@section('content')
<div class="cyber-page-header d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="cyber-page-title"><i class="fas fa-book"></i> Books</h1>
        <p class="cyber-page-subtitle mb-0">Manage your library collection</p>
    </div>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Book
    </a>
</div>

<!-- Search and Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('books.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search books, authors, ISBN...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="category">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="sort">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Added</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                    <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Author</option>
                    <option value="quantity" {{ request('sort') == 'quantity' ? 'selected' : '' }}>Quantity</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="btn-group w-100" role="group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @forelse($books as $book)
        <div class="col-md-6 col-lg-4 mb-4 reveal">
            <div class="card h-100 book-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book"></i> {{ $book->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="book-info">
                        <div class="info-item">
                            <i class="fas fa-user text-primary"></i>
                            <span><strong>Author:</strong> {{ $book->author }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-tag text-primary"></i>
                            <span><strong>Category:</strong> 
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                            </span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-barcode text-primary"></i>
                            <span><strong>ISBN:</strong> {{ $book->isbn }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-cubes text-primary"></i>
                            <span><strong>Quantity:</strong> {{ $book->quantity }}</span>
                        </div>
                        @if($book->price)
                            <div class="info-item">
                                <i class="fas fa-peso-sign text-primary"></i>
                                <span><strong>Price:</strong> ₱{{ number_format($book->price, 2) }}</span>
                            </div>
                        @endif
                    </div>
                    @if($book->description)
                        <div class="book-description mt-3">
                            <p class="card-text text-muted">{{ Str::limit($book->description, 100) }}</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-illustration"></div>
                <h3>No books yet</h3>
                <p class="mb-3">Start by adding your first book to the library.</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add a Book
                </a>
            </div>
        </div>
    @endforelse
</div>

@if($books->hasPages())
    <div class="pagination-container">
        {{ $books->links('pagination::bootstrap-5') }}
        <div class="pagination-info">
            <i class="fas fa-info-circle"></i>
            <span class="results-text">
                Showing <span class="highlight">{{ $books->firstItem() }}</span> to 
                <span class="highlight">{{ $books->lastItem() }}</span> of 
                <span class="highlight">{{ $books->total() }}</span> results
            </span>
        </div>
    </div>
@endif
@endsection
