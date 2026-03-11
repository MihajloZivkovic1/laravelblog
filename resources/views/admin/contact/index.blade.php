@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Contact Messages</h5>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $message)
                    <tr id="message-row-{{ $message->id }}">
                        <td class="text-muted">{{ $message->id }}</td>
                        <td><strong>{{ $message->name }}</strong></td>
                        <td class="text-muted">{{ $message->email }}</td>
                        <td>{{ Str::limit($message->subject, 30) }}</td>
                        <td class="text-muted">{{ Str::limit($message->message, 60) }}</td>
                        <td class="text-muted small">{{ $message->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button
                                    class="btn btn-sm btn-outline-primary view-message"
                                    data-id="{{ $message->id }}"
                                    data-name="{{ $message->name }}"
                                    data-email="{{ $message->email }}"
                                    data-subject="{{ $message->subject }}"
                                    data-message="{{ $message->message }}"
                                    data-date="{{ $message->created_at->format('M d, Y H:i') }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#messageModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button
                                    class="btn btn-sm btn-outline-danger delete-message"
                                    data-id="{{ $message->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No messages yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($messages->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $messages->links() }}
        </div>
    @endif

    {{-- Message Modal --}}
    <div class="modal fade" id="messageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">From</span>
                            <strong id="modal-name"></strong>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Email</span>
                            <a id="modal-email" href=""></a>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Subject</span>
                            <strong id="modal-subject"></strong>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Date</span>
                            <span id="modal-date" class="text-muted small"></span>
                        </li>
                    </ul>
                    <div class="bg-light rounded-3 p-3">
                        <p id="modal-message" class="mb-0"></p>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <a id="modal-reply" href="" class="btn btn-primary">
                        <i class="bi bi-reply"></i> Reply via Email
                    </a>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ── View Message Modal ──
        document.querySelectorAll('.view-message').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('modal-name').textContent    = this.dataset.name;
                document.getElementById('modal-email').textContent   = this.dataset.email;
                document.getElementById('modal-email').href          = `mailto:${this.dataset.email}`;
                document.getElementById('modal-subject').textContent = this.dataset.subject;
                document.getElementById('modal-message').textContent = this.dataset.message;
                document.getElementById('modal-date').textContent    = this.dataset.date;
                document.getElementById('modal-reply').href          = `mailto:${this.dataset.email}?subject=Re: ${this.dataset.subject}`;
            });
        });

        // ── Delete Message ──
        document.querySelectorAll('.delete-message').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Delete this message?')) return;

                const id = this.dataset.id;

                fetch(`/admin/contact/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`message-row-${id}`)?.remove();
                        }
                    });
            });
        });
    </script>
@endpush
