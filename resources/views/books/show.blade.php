@extends('layouts.app')

@section('title', 'Book Details')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('books.index') }}">
            <i class="fas fa-book"></i> Books
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-eye"></i> Book Details
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-book"></i> {{ $book->title }}</h4>
                <div class="btn-group">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-primary btn-sm">
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Author:</h6>
                        <p>{{ $book->author }}</p>
                        
                        <h6>ISBN:</h6>
                        <p>{{ $book->isbn }}</p>
                        
                        <h6>Category:</h6>
                        <p>
                            <span class="badge bg-primary">{{ $book->category->name }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6>Quantity:</h6>
                        <p>{{ $book->quantity }}</p>
                        
                        @if($book->price)
                            <h6>Price:</h6>
                            <p>₱{{ number_format($book->price, 2) }}</p>
                        @endif
                    </div>
                </div>
                
                @if($book->description)
                    <h6>Description:</h6>
                    <p>{{ $book->description }}</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle"></i> Book Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Created:</strong> {{ $book->created_at->format('M d, Y') }}</p>
                <p><strong>Last Updated:</strong> {{ $book->updated_at->format('M d, Y') }}</p>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5><i class="fas fa-tag"></i> Category Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Category:</strong> {{ $book->category->name }}</p>
                @if($book->category->description)
                    <p><strong>Description:</strong> {{ $book->category->description }}</p>
                @endif
                <a href="{{ route('categories.show', $book->category) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-eye"></i> View Category
                </a>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
