@extends('layouts.admin')

@section('title', 'Tags')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Tags</h5>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> New Tag
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Posts</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tags as $tag)
                    <tr id="tag-row-{{ $tag->id }}">
                        <td class="text-muted">{{ $tag->id }}</td>
                        <td><strong>{{ $tag->name }}</strong></td>
                        <td><code>{{ $tag->slug }}</code></td>
                        <td>{{ $tag->posts_count }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button
                                    class="btn btn-sm btn-outline-danger delete-tag"
                                    data-id="{{ $tag->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No tags yet. <a href="{{ route('admin.tags.create') }}">Create one</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.delete-tag').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Delete this tag?')) return;

                const id = this.dataset.id;

                fetch(`/admin/tags/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`tag-row-${id}`)?.remove();
                        }
                    });
            });
        });
    </script>
@endpush
