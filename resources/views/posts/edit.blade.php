@extends('format.layout')

@section('title', 'Edit Post')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Edit Post</h1>
        <p class="card-subtitle">Modify your post content</p>
    </div>
    <div class="card-body">
        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            
            <div class="form-group @error('title') error @enderror">
                <label for="title">Post Title <span class="required">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('user_id') error @enderror">
                <label for="user_id">Author <span class="required">*</span></label>
                <select name="user_id" id="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>
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
                <textarea name="content" id="content" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-light" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
