@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">

        {{-- Main Content --}}
        <div class="col-lg-8">

            {{-- Search Results Header --}}
            @if(isset($keyword))
                <div class="mb-4">
                    <h4>Search results for: <span class="text-accent">"{{ $keyword }}"</span></h4>
                    <p class="text-muted">{{ $posts->total() }} posts found</p>
                </div>
            @elseif(isset($category))
                <div class="mb-4">
                    <h4>Category: <span class="text-accent">{{ $category->name }}</span></h4>
                    <p class="text-muted">{{ $posts->total() }} posts found</p>
                </div>
            @elseif(isset($tag))
                <div class="mb-4">
                    <h4>Tag: <span class="text-accent">{{ $tag->name }}</span></h4>
                    <p class="text-muted">{{ $posts->total() }} posts found</p>
                </div>
            @else
                <h4 class="mb-4">Latest Posts</h4>
            @endif

            {{-- Posts Grid --}}
            @forelse($posts as $post)
                <div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="row g-0">

                        {{-- Featured Image --}}
                        @if($post->featured_image)
                            <div class="col-md-4">
                                <img
                                    src="{{ asset('storage/' . $post->featured_image) }}"
                                    class="img-fluid h-100 w-100"
                                    style="object-fit: cover; min-height: 200px;"
                                    alt="{{ $post->title }}"
                                >
                            </div>
                            <div class="col-md-8">
                                @else
                                    <div class="col-12">
                                        @endif

                                        <div class="card-body p-4">
                                            {{-- Category --}}
                                            <a href="{{ route('posts.category', $post->category->slug) }}"
                                               class="badge text-decoration-none mb-2"
                                               style="background: var(--accent); color: #fff;">
                                                {{ $post->category->name }}
                                            </a>

                                            {{-- Title --}}
                                            <h4 class="card-title">
                                                <a href="{{ route('posts.show', $post->slug) }}"
                                                   class="text-decoration-none text-dark">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>

                                            {{-- Excerpt --}}
                                            <p class="card-text text-muted">
                                                {{ Str::limit(strip_tags($post->body), 150) }}
                                            </p>

                                            {{-- Meta --}}
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <div class="d-flex align-items-center gap-3 text-muted small">
                                                    <span><i class="bi bi-person"></i> {{ $post->user->name }}</span>
                                                    <span><i class="bi bi-calendar3"></i> {{ $post->created_at->format('M d, Y') }}</span>
                                                    <span><i class="bi bi-chat"></i> {{ $post->comments->count() }}</span>
                                                </div>
                                                <a href="{{ route('posts.show', $post->slug) }}"
                                                   class="btn btn-sm btn-accent rounded-pill px-3">
                                                    Read More
                                                </a>
                                            </div>

                                            {{-- Tags --}}
                                            @if($post->tags->count())
                                                <div class="mt-3">
                                                    @foreach($post->tags as $tag)
                                                        <a href="{{ route('posts.tag', $tag->slug) }}"
                                                           class="badge text-decoration-none me-1"
                                                           style="background: #f1f5f9; color: #475569;">
                                                            #{{ $tag->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                    </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-journal-x" style="font-size: 3rem; color: #cbd5e1;"></i>
                            <h5 class="mt-3 text-muted">No posts found</h5>
                            @if(isset($keyword))
                                <p class="text-muted">Try a different search term</p>
                            @endif
                        </div>
                    @endforelse

                    {{-- Pagination --}}
                    @if($posts->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $posts->appends(request()->query())->links() }}
                        </div>
                    @endif

                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">

                    {{-- Search Widget --}}
                    <div class="sidebar-widget">
                        <h5><i class="bi bi-search"></i> Search</h5>
                        <form action="{{ route('posts.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control"
                                       placeholder="Search posts..."
                                       value="{{ request('q') }}">
                                <button class="btn btn-accent" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

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
