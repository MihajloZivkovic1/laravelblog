@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Edit User</h5>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4 pb-4 border-bottom">
                        <div style="width:52px;height:52px;background:#6366f1;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1.2rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $user->name }}</h6>
                            <small class="text-muted">{{ $user->email }}</small>
                        </div>
                    </div>

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                    User
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Admins have full access to the admin panel.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update Role
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">User Stats</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Posts</span>
                            <strong>{{ $user->posts->count() }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Comments</span>
                            <strong>{{ $user->comments->count() }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-2">
                            <span class="text-muted">Joined</span>
                            <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
