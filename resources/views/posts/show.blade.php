@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">

        {{-- Main Content --}}
        <div class="col-lg-8">

            {{-- Post --}}
            <article class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                {{-- Featured Image --}}
                @if($post->featured_image)
                    <img
                        src="{{ asset('storage/' . $post->featured_image) }}"
                        class="w-100"
                        style="max-height: 400px; object-fit: cover;"
                        alt="{{ $post->title }}"
                    >
                @endif

                <div class="card-body p-4 p-lg-5">

                    {{-- Category --}}
                    <a href="{{ route('posts.category', $post->category->slug) }}"
                       class="badge text-decoration-none mb-3"
                       style="background: var(--accent); color: #fff;">
                        {{ $post->category->name }}
                    </a>

                    {{-- Title --}}
                    <h1 class="mb-3">{{ $post->title }}</h1>

                    {{-- Meta --}}
                    <div class="d-flex align-items-center gap-4 text-muted mb-4 pb-4 border-bottom">
                        <span><i class="bi bi-person"></i> {{ $post->user->name }}</span>
                        <span><i class="bi bi-calendar3"></i> {{ $post->created_at->format('M d, Y') }}</span>
                        <span><i class="bi bi-chat"></i> {{ $post->comments->count() }} comments</span>
                    </div>

                    {{-- Body --}}
                    <div class="post-body" style="line-height: 1.9; font-size: 1.05rem;">
                        {!! nl2br(e($post->body)) !!}
                    </div>

                    {{-- Tags --}}
                    @if($post->tags->count())
                        <div class="mt-4 pt-4 border-top">
                            <span class="text-muted me-2">Tags:</span>
                            @foreach($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag->slug) }}"
                                   class="badge text-decoration-none me-1"
                                   style="background: #f1f5f9; color: #475569; font-size: 0.85rem;">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                </div>
            </article>

            {{-- Comments Section --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">
                        <i class="bi bi-chat-dots"></i>
                        Comments <span class="text-muted fs-6">({{ $post->comments->count() }})</span>
                    </h4>

                    {{-- Comment Form --}}
                    @auth
                        <form id="commentForm" class="mb-4">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                            <textarea
                                name="body"
                                id="commentBody"
                                class="form-control rounded-3"
                                rows="3"
                                placeholder="Write a comment..."
                                required
                            ></textarea>
                            </div>
                            <button type="submit" class="btn btn-accent px-4">
                                <i class="bi bi-send"></i> Post Comment
                            </button>
                        </form>
                    @else
                        <div class="alert alert-light border mb-4">
                            <i class="bi bi-info-circle"></i>
                            <a href="{{ route('login') }}">Login</a> to post a comment.
                        </div>
                    @endauth

                    {{-- Comments List --}}
                    <div id="commentsList">
                        @forelse($post->comments as $comment)
                            <div class="d-flex gap-3 mb-4 comment-item" id="comment-{{ $comment->id }}">
                                <div class="flex-shrink-0">
                                    <div style="width:40px;height:40px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $comment->user->name }}</strong>
                                            <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        @if(auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->isAdmin()))
                                            <button
                                                class="btn btn-sm btn-outline-danger rounded-pill delete-comment"
                                                data-id="{{ $comment->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <p class="mt-2 mb-0">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center py-3" id="noComments">
                                No comments yet. Be the first to comment!
                            </p>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">

            {{-- Categories Widget --}}
            <div class="sidebar-widget">
                <h5><i class="bi bi-folder"></i> Categories</h5>
                <ul class="list-unstyled mb-0">
                    @foreach($categories as $cat)
                        <li class="mb-2">
                            <a href="{{ route('posts.category', $cat->slug) }}"
                               class="d-flex justify-content-between text-decoration-none text-dark">
                                <span>{{ $cat->name }}</span>
                                <span class="badge rounded-pill"
                                      style="background: var(--accent); color: #fff;">
                                {{ $cat->posts->count() }}
                            </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Tags Widget --}}
            <div class="sidebar-widget">
                <h5><i class="bi bi-tags"></i> Tags</h5>
                <div>
                    @foreach($tags as $tag)
                        <a href="{{ route('posts.tag', $tag->slug) }}"
                           class="badge text-decoration-none me-1 mb-2 p-2"
                           style="background: #f1f5f9; color: #475569; font-size: 0.85rem;">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ── Submit Comment via AJAX ──
        document.getElementById('commentForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const body = document.getElementById('commentBody').value;
            const postId = this.querySelector('[name="post_id"]').value;

            fetch('/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ post_id: postId, body: body })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Remove "no comments" message if present
                        document.getElementById('noComments')?.remove();

                        // Prepend new comment to list
                        const html = `
                    <div class="d-flex gap-3 mb-4 comment-item" id="comment-${data.comment.id}">
                        <div class="flex-shrink-0">
                            <div style="width:40px;height:40px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                ${data.comment.user.charAt(0).toUpperCase()}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${data.comment.user}</strong>
                                    <small class="text-muted ms-2">${data.comment.created_at}</small>
                                </div>
                                <button class="btn btn-sm btn-outline-danger rounded-pill delete-comment" data-id="${data.comment.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <p class="mt-2 mb-0">${data.comment.body}</p>
                        </div>
                    </div>`;

                        document.getElementById('commentsList').insertAdjacentHTML('afterbegin', html);
                        document.getElementById('commentBody').value = '';
                    }
                });
        });

        // ── Delete Comment via AJAX ──
        document.getElementById('commentsList').addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-comment');
            if (!btn) return;

            const id = btn.dataset.id;

            fetch(`/comments/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`comment-${id}`)?.remove();
                    }
                });
        });
    </script>
@endpush
