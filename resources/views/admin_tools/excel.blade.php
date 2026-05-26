@extends('format.layout')

@section('title', 'Excel')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i class="bi bi-file-earmark-spreadsheet"></i> Excel</h1>
        <p class="card-subtitle">Import records or export the current student records as Excel.</p>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="button-group">
            <a href="{{ route('admin.excel.export') }}" class="btn" data-no-ajax><i class="bi bi-download"></i> Export Student Excel</a>
        </div>

        <hr style="margin: 1.5rem 0;">

        <form action="{{ route('admin.excel.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Excel File</label>
                <input id="file" type="file" name="file" accept=".xlsx,.xls,.csv" required>
            </div>
            <div class="button-group" style="margin-top: 1rem;">
                <button type="submit" class="btn"><i class="bi bi-upload"></i> Import Excel</button>
            </div>
        </form>
    </div>
</div>
@endsection