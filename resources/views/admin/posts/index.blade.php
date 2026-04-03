@extends('layouts.admin')

@section('title', 'Posts')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Posts</h5>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> New Post
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr id="post-row-{{ $post->id }}">
                        <td class="text-muted">{{ $post->id }}</td>
                        <td>
                            <strong>{{ $post->title }}</strong>
                            <br>
                            <small class="text-muted">{{ $post->comments->count() }} comments</small>
                        </td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge-published">Published</span>
                            @else
                                <span class="badge-draft">Draft</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $post->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                   class="btn btn-sm btn-outline-secondary"
                                   target="_blank">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button
                                    class="btn btn-sm btn-outline-danger delete-post"
                                    data-id="{{ $post->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No posts yet. <a href="{{ route('admin.posts.create') }}">Create one</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($posts->hasPages())
        <div class="d-flex justify-content-center align-items-center gap-1 mt-4">
            @if($posts->onFirstPage())
                <span class="btn btn-sm btn-light rounded-pill px-3 disabled text-muted">
                <i class="bi bi-chevron-left"></i>
            </span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" class="btn btn-sm btn-light rounded-pill px-3">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                @if($page == $posts->currentPage())
                    <span class="btn btn-sm rounded-pill px-3" style="background: var(--accent); color: black;">
                    {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" class="btn btn-sm btn-light rounded-pill px-3">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" class="btn btn-sm btn-light rounded-pill px-3">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="btn btn-sm btn-light rounded-pill px-3 disabled text-muted">
                <i class="bi bi-chevron-right"></i>
            </span>
            @endif
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.delete-post').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Are you sure you want to delete this post?')) return;

                const id = this.dataset.id;

                fetch(`/admin/posts/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`post-row-${id}`)?.remove();
                        }
                    });
            });
        });
    </script>
@endpush
