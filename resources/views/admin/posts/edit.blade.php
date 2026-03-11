@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Edit Post</h5>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">Post Content</div>
                    <div class="card-body p-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $post->title) }}"
                                required
                            >
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Body</label>
                            <textarea
                                name="body"
                                class="form-control @error('body') is-invalid @enderror"
                                rows="15"
                                required
                            >{{ old('body', $post->body) }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Sidebar Options --}}
            <div class="col-lg-4">

                {{-- Publish --}}
                <div class="card mb-4">
                    <div class="card-header">Publish</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>
                                <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                                    Published
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> Update Post
                        </button>
                    </div>
                </div>

                {{-- Category --}}
                <div class="card mb-4">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <select name="category_id"
                                class="form-select @error('category_id') is-invalid @enderror"
                                required>
                            <option value="">Select category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tags --}}
                <div class="card mb-4">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        @foreach($tags as $tag)
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="tags[]"
                                    value="{{ $tag->id }}"
                                    id="tag-{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="tag-{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="card mb-4">
                    <div class="card-header">Featured Image</div>
                    <div class="card-body">

                        {{-- Current Image --}}
                        @if($post->featured_image)
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Current image:</small>
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     class="img-fluid rounded"
                                     alt="Current image">
                            </div>
                        @endif

                        <label class="form-label fw-semibold">
                            {{ $post->featured_image ? 'Replace Image' : 'Upload Image' }}
                        </label>
                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/*"
                            id="imageInput"
                        >
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="imagePreview" class="mt-3 d-none">
                            <small class="text-muted d-block mb-2">New image:</small>
                            <img id="previewImg" src="" class="img-fluid rounded" alt="Preview">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

@push('scripts')
    <script>
        // Image preview before upload
        document.getElementById('imageInput').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
