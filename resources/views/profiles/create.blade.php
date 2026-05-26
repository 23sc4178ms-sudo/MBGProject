@extends('format.layout2')

@section('title', 'Create Profile')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Create User Profile</h1>
        <p class="card-subtitle">Set up a profile for a user</p>
    </div>
    <div class="card-body">
        <form action="{{ route('profiles.store') }}" method="POST" class="form-container">
            @csrf
            
            <div class="form-group @error('user_id') error @enderror">
                <label for="user_id">User <span class="required">*</span></label>
                <select name="user_id" id="user_id" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                @if($users->isEmpty())
                    <span class="form-text text-muted" style="margin-top: 5px; font-size: 0.8rem; color: #666;">All users already have profiles.</span>
                @endif
            </div>

            <div class="form-group @error('bio') error @enderror">
                <label for="bio">Bio <span class="required">*</span></label>
                <textarea name="bio" id="bio" placeholder="Tell us something about the user..." required>{{ old('bio') }}</textarea>
                @error('bio')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn" {{ $users->isEmpty() ? 'disabled' : '' }}><i class="bi bi-check-circle"></i> Create Profile</button>
                <a href="{{ route('profiles.index') }}" class="btn btn-secondary" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
