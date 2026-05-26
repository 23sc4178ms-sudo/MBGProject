<form action="{{ route('students.update', $student->id) }}" method="POST" class="student-modal-form" aria-label="Edit student form">
    @csrf
    @method('PUT')

    <fieldset>
        <legend>Personal Information</legend>

        <div class="form-group">
            <label for="modal-name">First Name <span class="required" aria-label="required">*</span></label>
            <input type="text" name="name" id="modal-name" value="{{ old('name', $student->name) }}" required>
        </div>

        <div class="form-group">
            <label for="modal-mname">Middle Name</label>
            <input type="text" name="mname" id="modal-mname" value="{{ old('mname', $student->mname ?? '') }}">
        </div>

        <div class="form-group">
            <label for="modal-lname">Last Name <span class="required" aria-label="required">*</span></label>
            <input type="text" name="lname" id="modal-lname" value="{{ old('lname', $student->lname) }}" required>
        </div>
    </fieldset>

    <fieldset>
        <legend>Contact Information</legend>

        <div class="form-group">
            <label for="modal-email">Email <span class="required" aria-label="required">*</span></label>
            <input type="email" name="email" id="modal-email" value="{{ old('email', $student->email) }}" required>
        </div>

        <div class="form-group">
            <label for="modal-contact">Contact Number <span class="required" aria-label="required">*</span></label>
            <input type="tel" name="contact" id="modal-contact" value="{{ old('contact', $student->contact) }}" required>
        </div>
    </fieldset>

    <fieldset>
        <legend>Academic Information</legend>

        <div class="form-group">
            <label for="modal-degree-id">Course <span class="required" aria-label="required">*</span></label>
            <select name="degree_id" id="modal-degree-id" required>
                <option value="" disabled>Select a course</option>
                @foreach($degrees as $degree)
                    <option value="{{ $degree->id }}" {{ old('degree_id', $student->degree_id) == $degree->id ? 'selected' : '' }}>{{ $degree->Degree }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>

    <div class="button-group" role="group" aria-label="Form actions">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Update Student
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Cancel
        </button>
    </div>
</form>
