@extends('format.layout2')

@section('title', 'Edit Profile')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Edit Profile</h1>
        <p class="card-subtitle">Update profile for {{ $profile->user->name }}</p>
    </div>
    <div class="card-body">
        <form action="{{ route('profiles.update', $profile->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>User</label>
                <input type="text" value="{{ $profile->user->name }}" disabled>
            </div>

            <div class="form-group @error('bio') error @enderror">
                <label for="bio">Bio <span class="required">*</span></label>
                <textarea name="bio" id="bio" required>{{ old('bio', $profile->bio) }}</textarea>
                @error('bio')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn"><i class="bi bi-check-circle"></i> Update Profile</button>
                <a href="{{ route('profiles.index') }}" class="btn btn-secondary" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
