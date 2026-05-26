@extends('format.layout')

@section('title')
    jQuery Demo Page
@endsection

@section('content')

<div class="container mt-4">

    <h2 class="text-primary border-bottom border-primary pb-2">jQuery Demo Page</h2>

    {{-- CLICK --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Click Event</h5>
            <button id="demoButton" class="btn btn-primary">Click Me</button>
            <p id="clickResult" class="mt-2 text-success"></p>
        </div>
    </div>

    {{-- HOVER --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Hover Event</h5>
            <p id="demoHover" class="p-3 border">Hover over me 🎯</p>
        </div>
    </div>

    {{-- SHOW / HIDE / TOGGLE --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Show / Hide / Toggle</h5>

            <button id="showBtn" class="btn btn-success">Show</button>
            <button id="hideBtn" class="btn btn-danger">Hide</button>
            <button id="toggleBtn" class="btn btn-warning">Toggle</button>

            <p id="toggleText" class="mt-3">Hello Laravel + jQuery 👋</p>
        </div>
    </div>

    {{-- FADE --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Fade Effects</h5>

            <button id="fadeInBtn" class="btn btn-primary">Fade In</button>
            <button id="fadeOutBtn" class="btn btn-secondary">Fade Out</button>

            <p id="fadeText" class="mt-3">Fade me in and out ✨</p>
        </div>
    </div>

    {{-- SLIDE --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Slide Effects</h5>

            <button id="slideBtn" class="btn btn-dark">Slide Toggle</button>

            <p id="slideText" class="mt-3 border p-2">Sliding content 📦</p>
        </div>
    </div>

    {{-- AJAX --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">AJAX Request</h5>

            <button id="ajaxBtn" class="btn btn-warning">Get Data</button>

            <p id="ajaxResult" class="mt-3 text-info fw-bold"></p>
        </div>
    </div>

</div>

@endsection