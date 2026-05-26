@extends('format.layout')

@section('title', 'Session Expired')

@section('content')
<div style="text-align: center; padding: 3rem 2rem; background-color: #f8f9fa; border-radius: 8px; margin: 3rem auto; max-width: 500px;">
    <h2 style="color: #d32f2f; margin-bottom: 1rem;">⚠️ Session Expired</h2>
    <p style="color: #666; margin-bottom: 2rem;">Your session has expired. Please login again to continue.</p>
    <p style="color: #999; font-size: 0.9rem;">Redirecting to login in <span id="countdown">3</span> seconds...</p>
</div>

<script>
    let count = 3;
    const countdownElement = document.getElementById('countdown');
    
    // Update countdown every second
    setInterval(function() {
        count--;
        if (countdownElement) {
            countdownElement.textContent = count;
        }
        if (count <= 0) {
            window.location.href = "{{ route('login') }}";
        }
    }, 1000);
</script>
@endsection
