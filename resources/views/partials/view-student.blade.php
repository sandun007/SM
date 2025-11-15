<div class="modal-body p-4 p-md-5 bg-light">
    <div class="text-center mb-4">
        <div class="avatar bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center"
             style="width:80px; height:80px; font-size:2rem;">
            {{ strtoupper(substr($student->name, 0, 1)) }}
        </div>
        <h5 class="mt-3 fw-bold">{{ $student->name }}</h5>
        <p class="text-muted">Student Profile</p>
    </div>

    <div class="row g-3 text-start">
        <div class="col-12">
            <label class="form-label fw-semibold text-muted">Full Name</label>
            <p class="mb-0">{{ $student->name }}</p>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold text-muted">Email Address</label>
            <p class="mb-0">{{ $student->email }}</p>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label fw-semibold text-muted">Age</label>
            <p class="mb-0">{{ $student->age }} years</p>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label fw-semibold text-muted">Course</label>
            <p class="mb-0">{{ $student->course }}</p>
        </div>
    </div>

    <div class="modal-footer bg-light border-0 px-0 pt-4 mt-4 justify-content-center">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</div>
