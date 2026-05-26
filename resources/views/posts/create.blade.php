@extends('format.layout2')

@section('title', 'Create Post')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Create New Post</h1>
        <p class="card-subtitle">Share something with the community</p>
    </div>
    <div class="card-body">
        <form action="{{ route('posts.store') }}" method="POST" class="form-container">
            @csrf
            
            <div class="form-group @error('title') error @enderror">
                <label for="title">Post Title <span class="required">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="What's on your mind?" required>
                @error('title')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('user_id') error @enderror">
                <label for="user_id">Author <span class="required">*</span></label>
                <select name="user_id" id="user_id" required>
                    <option value="">Select Author</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('content') error @enderror">
                <label for="content">Content <span class="required">*</span></label>
                <textarea name="content" id="content" placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                @error('content')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn"><i class="bi bi-send"></i> Publish Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
