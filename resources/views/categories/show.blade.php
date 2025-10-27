@extends('layouts.app')

@section('title', 'Category Details')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}">
            <i class="fas fa-tags"></i> Categories
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-eye"></i> Category Details
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-tag"></i> {{ $category->name }}</h4>
                <div class="btn-group">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this category?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <h6>Description:</h6>
                <p>{{ $category->description ?: 'No description provided.' }}</p>
                
                <h6>Books in this category:</h6>
                @if($category->books->count() > 0)
                    <div class="row">
                        @foreach($category->books as $book)
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $book->title }}</h6>
                                        <p class="card-text">
                                            <small class="text-muted">by {{ $book->author }}</small><br>
                                            <small class="text-muted">ISBN: {{ $book->isbn }}</small>
                                        </p>
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> View Book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No books in this category yet.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle"></i> Category Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Books:</strong> {{ $category->books->count() }}</p>
                <p><strong>Created:</strong> {{ $category->created_at->format('M d, Y') }}</p>
                <p><strong>Last Updated:</strong> {{ $category->updated_at->format('M d, Y') }}</p>
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
