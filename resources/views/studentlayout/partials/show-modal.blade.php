<div class="student-modal-summary">
    <div class="student-modal-heading">
        <h3>{{ $student->name }} {{ $student->mname }} {{ $student->lname }}</h3>
        <span>ID: {{ $student->id }}</span>
    </div>

    <div class="student-modal-grid">
        <div class="student-modal-field">
            <span>Full Name</span>
            <strong>{{ $student->lname }}, {{ $student->name }} {{ $student->mname }}</strong>
        </div>
        <div class="student-modal-field">
            <span>Course</span>
            <strong>{{ $student->degree?->Degree ?? 'N/A' }}</strong>
        </div>
        <div class="student-modal-field">
            <span>Email</span>
            <strong>{{ $student->email }}</strong>
        </div>
        <div class="student-modal-field">
            <span>Contact</span>
            <strong>{{ $student->contact }}</strong>
        </div>
        <div class="student-modal-field">
            <span>Status</span>
            <strong>Enrolled</strong>
        </div>
    </div>
</div>
