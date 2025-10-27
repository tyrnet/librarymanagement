@extends('layouts.app')

@section('title', 'Edit Category')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}">
            <i class="fas fa-tags"></i> Categories
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-edit"></i> Edit Category
    </li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Category Name" required>
                        <label for="name">Category Name <span class="text-danger">*</span></label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" placeholder="Description" style="height: 120px">{{ old('description', $category->description) }}</textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
