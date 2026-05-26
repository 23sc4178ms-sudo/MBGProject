@extends('format.layout')

@section('title', 'View Post')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">{{ $post->title }}</h1>
        <p class="card-subtitle">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
    </div>
    <div class="card-body">
        <div class="post-content" style="font-size: 1.1rem; line-height: 1.6; color: var(--text-primary);">
            {{ $post->content }}
        </div>
        
        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary"><i class="bi bi-pencil-square"></i> Edit Post</a>
            <a href="{{ route('posts.index') }}" class="btn btn-light" data-no-ajax><i class="bi bi-arrow-left"></i> Back to Feed</a>
        </div>
    </div>
</div>
@endsection
