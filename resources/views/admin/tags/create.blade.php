@extends('layouts.admin')

@section('title', 'Create Tag')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Create Tag</h5>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf

                <div class="mb-3 col-lg-6">
                    <label class="form-label fw-semibold">Tag Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="e.g. Laravel"
                        required
                    >
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Slug will be auto-generated from the name.</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Tag
                </button>
            </form>
        </div>
    </div>

@endsection
