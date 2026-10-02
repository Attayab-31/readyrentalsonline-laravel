@extends('layouts.accounts')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h1 class="h4 mb-1">User profile</h1>
            <p class="text-muted mb-0">Account details and status.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('users.index') }}" class="btn btn-soft-secondary">Back to users</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit user</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-4">
            <section class="card h-100">
                <div class="card-body text-center">
                    <img
                        src="{{ $user->getProfilePicture($user->profile_picture) }}"
                        class="rounded-circle avatar-lg img-thumbnail mb-3"
                        alt="{{ $user->first_name }} {{ $user->last_name }}"
                    >
                    <h2 class="h5 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    <span class="badge {{ $user->account_status === 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($user->account_status) }}
                    </span>
                </div>
            </section>
        </div>

        <div class="col-12 col-lg-8">
            <section class="card h-100">
                <div class="card-header">
                    <h2 class="h5 card-title mb-0">Account details</h2>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">User type</dt>
                        <dd class="col-sm-8">{{ $user->isSuperAdmin() ? 'Super Admin' : ucfirst($user->user_type) }}</dd>

                        <dt class="col-sm-4">Email verification</dt>
                        <dd class="col-sm-8">
                            {{ $user->email_verified_at ? 'Verified' : 'Not verified' }}
                        </dd>

                        <dt class="col-sm-4">Member since</dt>
                        <dd class="col-sm-8">{{ $user->created_at->format('F j, Y') }}</dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>
@endsection
