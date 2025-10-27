@extends('layouts.app')

@section('title', 'Categories')

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-tags"></i> Categories
    </li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1><i class="fas fa-tags"></i> Categories</h1>
        <p class="text-muted mb-0">Organize your books by categories</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Category
    </a>
</div>

<!-- Search Section -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('categories.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search categories...">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="sort">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                    <option value="books_count" {{ request('sort') == 'books_count' ? 'selected' : '' }}>Number of Books</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="btn-group w-100" role="group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @forelse($categories as $category)
        <div class="col-md-6 col-lg-4 mb-4 reveal">
            <div class="card h-100 category-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tag"></i> {{ $category->name }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="category-info">
                        <div class="info-item">
                            <i class="fas fa-book text-primary"></i>
                            <span><strong>{{ $category->books_count }}</strong> books</span>
                        </div>
                        @if($category->description)
                            <div class="category-description mt-3">
                                <p class="card-text text-muted">{{ Str::limit($category->description, 100) }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-secondary btn-sm">
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
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-illustration"></div>
                <h3>No categories yet</h3>
                <p class="mb-3">Create a category to organize your books.</p>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-tag"></i> Add a Category
                </a>
            </div>
        </div>
    @endforelse
</div>

@if($categories->hasPages())
    <div class="pagination-container">
        {{ $categories->links('pagination::bootstrap-5') }}
        <div class="pagination-info">
            <i class="fas fa-info-circle"></i>
            <span class="results-text">
                Showing <span class="highlight">{{ $categories->firstItem() }}</span> to 
                <span class="highlight">{{ $categories->lastItem() }}</span> of 
                <span class="highlight">{{ $categories->total() }}</span> results
            </span>
        </div>
    </div>
@endif
@endsection
