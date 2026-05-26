@extends('format.layout')

@section('title', 'PDF')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i class="bi bi-file-earmark-pdf"></i> PDF</h1>
        <p class="card-subtitle">Export the current student records as a PDF report.</p>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <a href="{{ route('admin.pdf.download') }}" class="btn" data-no-ajax><i class="bi bi-download"></i> Export Student PDF</a>
    </div>
</div>
@endsection