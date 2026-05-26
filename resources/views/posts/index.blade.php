@extends('format.layout')

@section('title', 'Posts')

@section('content')

<style>
    .posts-header {
        margin-bottom: 2rem;
    }

    .posts-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
    }

    .action-buttons {
        margin-bottom: 1.5rem;
    }

    .btn {
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .success-alert {
        padding: 1rem;
        background-color: #f0fdf4;
        border-left: 4px solid var(--success);
        color: #166534;
        margin-bottom: 1rem;
        border-radius: 4px;
    }

    /* TABLE STYLE */
    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    thead {
        background: var(--primary);
        color: #fff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    tbody tr {
        border-bottom: 1px solid #eee;
        transition: var(--transition-fast);
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition-fast);
    }

    .view { background: #dbeafe; color: #0369a1; }
    .view:hover { background: #bfdbfe; }
    
    .edit { background: #fef3c7; color: #b45309; }
    .edit:hover { background: #fde68a; }

    .delete { background: #fee2e2; color: #991b1b; }
    .delete:hover { background: #fecaca; }

    .author-badge {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.8rem;
        color: #475569;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #fff;
        border: 2px dashed var(--border);
        border-radius: 12px;
        margin-top: 1rem;
    }
</style>

<section class="posts-header">
    <h1>All Posts</h1>
</section>

@if(session('success'))
    <div class="success-alert">
        {{ session('success') }}
    </div>
@endif

<div class="action-buttons">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Create New Post
    </a>
</div>

@if($posts->count() > 0)
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date Posted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>#{{ $post->id }}</td>
                    <td><strong>{{ $post->title }}</strong></td>
                    <td><span class="author-badge">{{ $post->user->name }}</span></td>
                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('posts.show', $post->id) }}" class="action-btn view" title="View post">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="action-btn edit" title="Edit post">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" onclick="return confirm('Delete this post?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="empty-state">
    <h3>No Posts Found</h3>
    <p>Be the first to share something with the community.</p>
    <a href="{{ route('posts.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create First Post</a>
</div>
@endif

@endsection

