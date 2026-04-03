@extends('layouts.admin')

@section('title', 'Comments')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Comments</h5>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Comment</th>
                    <th>Author</th>
                    <th>Post</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($comments as $comment)
                    <tr id="comment-row-{{ $comment->id }}">
                        <td class="text-muted">{{ $comment->id }}</td>
                        <td>{{ Str::limit($comment->body, 60) }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:28px;height:28px;background:#6366f1;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                {{ $comment->user->name }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('posts.show', $comment->post->slug) }}"
                               class="text-decoration-none"
                               target="_blank">
                                {{ Str::limit($comment->post->title, 30) }}
                                <i class="bi bi-box-arrow-up-right small"></i>
                            </a>
                        </td>
                        <td class="text-muted small">{{ $comment->created_at->format('M d, Y') }}</td>
                        <td>
                            <button
                                class="btn btn-sm btn-outline-danger delete-comment"
                                data-id="{{ $comment->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No comments yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($comments->hasPages())
        <div class="d-flex justify-content-center align-items-center gap-1 mt-4">
            @if($comments->onFirstPage())
                <span class="btn btn-sm btn-light rounded-pill px-3 disabled text-muted">
                <i class="bi bi-chevron-left"></i>
            </span>
            @else
                <a href="{{ $comments->previousPageUrl() }}" class="btn btn-sm btn-light rounded-pill px-3">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            @foreach($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
                @if($page == $comments->currentPage())
                    <span class="btn btn-sm rounded-pill px-3" style="background: var(--accent); color: black;">
                    {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" class="btn btn-sm btn-light rounded-pill px-3">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if($comments->hasMorePages())
                <a href="{{ $comments->nextPageUrl() }}" class="btn btn-sm btn-light rounded-pill px-3">
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

        document.querySelectorAll('.delete-comment').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Delete this comment?')) return;

                const id = this.dataset.id;

                fetch(`/admin/comments/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`comment-row-${id}`)?.remove();
                        }
                    });
            });
        });
    </script>
@endpush
