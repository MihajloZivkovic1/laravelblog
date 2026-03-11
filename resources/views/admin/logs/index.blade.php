@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Activity Logs</h5>
    </div>

    {{-- Date Filter --}}
    <div class="card mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.logs.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">From</label>
                    <input
                        type="date"
                        name="from"
                        class="form-control"
                        value="{{ $from ?? '' }}"
                    >
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">To</label>
                    <input
                        type="date"
                        name="to"
                        class="form-control"
                        value="{{ $to ?? '' }}"
                    >
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i> Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Logs Table --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>IP Address</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td class="text-muted">{{ $log->id }}</td>
                        <td>
                            <code class="px-2 py-1 rounded"
                                  style="background:#f1f5f9;color:#6366f1;font-size:0.8rem;">
                                {{ $log->action }}
                            </code>
                        </td>
                        <td>{{ $log->description }}</td>
                        <td>
                            @if($log->user)
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:28px;height:28px;background:#6366f1;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                                        {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                    </div>
                                    {{ $log->user->name }}
                                </div>
                            @else
                                <span class="text-muted">Guest</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $log->ip_address ?? '—' }}</td>
                        <td class="text-muted small">{{ $log->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No activity logs found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($logs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $logs->appends(request()->query())->links() }}
        </div>
    @endif

@endsection
