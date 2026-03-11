@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Create Category</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-4" style="max-width: 500px;">
                    <label class="form-label fw-semibold">Category Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="e.g. Technology"
                        required
                    >
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Slug will be auto-generated from the name.</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Category
                </button>
            </form>
        </div>
    </div>

@endsection
