@extends('format.layout')

@section('title', 'Maintenance Settings')

@section('content')

<style>
/* ===== WRAPPER ===== */
.maintenance-wrapper {
    width: min(100%, 900px);
    margin: auto;
    min-width: 0;
}

/* ===== CARD ===== */
.maintenance-card {
    background: var(--bg-white);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    overflow: hidden;
    border: 1px solid var(--border-light);
    min-width: 0;
}

/* ===== HEADER ===== */
.maintenance-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    text-align: center;
    padding: 1.5rem;
}

.maintenance-header h2 {
    margin: 0;
    font-weight: 700;
}

/* ===== FORM SECTION ===== */
.form-section {
    padding: 2rem;
    min-width: 0;
}

/* GRID FORM (PANTAY) */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.form-select {
    width: 100%;
    padding: 0.75rem;
    border-radius: 10px;
    border: 1px solid var(--border-light);
}

/* FULL BUTTON */
.btn-apply {
    margin-top: 1.5rem;
    width: 100%;
    padding: 0.9rem;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    cursor: pointer;
    transition: 0.3s;
}

.btn-apply:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* ===== STATUS SECTION ===== */
.status-section {
    margin-top: 2rem;
    min-width: 0;
    overflow-x: auto;
}

/* TABLE CLEAN */
.status-table {
    width: 100%;
    min-width: 0 !important;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    table-layout: fixed;
}

.status-table th {
    background: var(--bg-light);
    padding: 1rem;
    text-align: center;
    font-weight: 700;
    color: var(--primary);
    white-space: nowrap;
}

.status-table td {
    padding: 1rem;
    text-align: center;
    border-top: 1px solid var(--border-light);
    word-break: break-word;
}

/* BADGES */
.badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

.badge-maintenance {
    background: #fef3c7;
    color: #92400e;
}

.badge-promo {
    background: #dcfce7;
    color: #166534;
}

.badge-normal {
    background: #e5e7eb;
    color: #374151;
}

/* RESTORE BUTTON */
.btn-restore {
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    border: 1px solid #22c55e;
    background: transparent;
    color: #22c55e;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-restore:hover {
    background: #22c55e;
    color: white;
}

/* ALERT */
.alert-success {
    margin-top: 1rem;
    padding: 1rem;
    border-radius: 10px;
    background: #ecfdf5;
    border-left: 4px solid #22c55e;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-section {
        padding: 1rem;
    }

    .status-table th,
    .status-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
    }
}
</style>

<div class="maintenance-wrapper">

    <div class="maintenance-card">

        <!-- HEADER -->
        <div class="maintenance-header">
            <h2>⚙️ Maintenance & Promo Settings</h2>
        </div>

        <!-- FORM -->
        <div class="form-section">

            <form method="POST" action="{{ url('/maintenance') }}">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Select Type</label>
                        <select name="mode" class="form-select" required>
                            <option value="maintenance">Down for Maintenance</option>
                            <option value="promo">Promo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Page</label>
                        <select name="target_page" class="form-select" required>
                            <option value="dashboard">Dashboard</option>
                            <option value="students">Students</option>
                            <option value="degrees">Degrees</option>
                            <option value="courses">Courses</option>
                            <option value="enrollments">Enrollments</option>
                            <option value="users">Users</option>
                            <option value="profiles">Profiles</option>
                            <option value="posts">Posts</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn-apply">
                    🚀 Apply Changes
                </button>

            </form>

            <!-- STATUS -->
            <div class="status-section">

                <h5 style="margin-top:2rem;">📊 Current Page Status</h5>

                <table class="status-table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($statuses as $page => $status)
                        <tr>
                            <td>{{ ucfirst($page) }}</td>

                            <td>
                                @if($status === 'maintenance')
                                    <span class="badge badge-maintenance">Maintenance</span>
                                @elseif($status === 'promo')
                                    <span class="badge badge-promo">Promo</span>
                                @else
                                    <span class="badge badge-normal">Normal</span>
                                @endif
                            </td>

                            <td>
                                @if($status !== 'normal')
                                <form method="POST" action="{{ url('/maintenance') }}">
                                    @csrf
                                    <input type="hidden" name="target_page" value="{{ $page }}">
                                    <input type="hidden" name="mode" value="normal">
                                    <button type="submit" class="btn-restore">
                                        Restore
                                    </button>
                                </form>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>

@endsection
