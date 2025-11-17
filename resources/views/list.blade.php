<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

@include('component.navbar')

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div class="flex-grow-1 text-center">
                <h4 class="mb-0">Registered Students</h4>
            </div>
            <button type="button" class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                <i class="bi bi-plus-circle"></i> Add New Student
            </button>
            <form class="d-flex" onsubmit="return false;">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Search students..." id="searchInput" style="width: 250px;">
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="studentsTable">
                    <thead class="table-dark">
                    <tr>
                        <th>Student Name</th>
                        <th>Student Details</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="studentsBody">
                    @foreach($students as $student)
                        <tr data-id="{{ $student->id }}">
                            <td><strong>{{ $student->name }}</strong></td>
                            <td>
                                <small class='text-muted'>{{ $student->email }}</small><br>
                                Age: {{ $student->age }} | Course: {{ $student->course }}
                            </td>
                            <td class='text-center'>
                                <button type="button" class="btn btn-info btn-sm"
                                        onclick="viewStudent({{ $student->id }})">
                                    View
                                </button>
                                <button type="button" class="btn btn-warning btn-sm"
                                        onclick="loadUpdateForm({{ $student->id }})">
                                    Update
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteStudent({{ $student->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1"
     aria-labelledby="registerModalLabel" aria-hidden="true"
     data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow rounded-3 overflow-hidden">

            <div class="modal-header border-0 py-4 position-relative overflow-hidden d-flex justify-content-center align-items-center" style="min-height:80px;">
                <div class="position-absolute start-0 top-0 w-100 h-100"
                     style="background:url('https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1350&q=80') center/cover;"></div>
                <div class="position-absolute start-0 top-0 w-100 h-100"></div>

                <h5 class="modal-title fs-4 fw-bold text-white mb-0" style="z-index:1;">Student Registration</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 p-md-5 bg-light">
                @include('register')
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow rounded-3 overflow-hidden">

            <div class="modal-header border-0 py-4 position-relative overflow-hidden d-flex justify-content-center align-items-center" style="min-height:80px;">
                <div class="position-absolute start-0 top-0 w-100 h-100"
                     style="background:url('https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1350&q=80') center/cover;"></div>
                <div class="position-absolute start-0 top-0 w-100 h-100"></div>

                <h5 class="modal-title fs-4 fw-bold text-white mb-0" style="z-index:1;">Update Student</h5>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 me-3 mt-3"
                        data-bs-dismiss="modal" style="z-index:1;">
                </button>
            </div>

            <div id="updateModalBody">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow rounded-3 overflow-hidden">

            <div class="modal-header border-0 py-4 position-relative overflow-hidden d-flex justify-content-center align-items-center" style="min-height:80px;">
                <div class="position-absolute start-0 top-0 w-100 h-100"
                     style="background:url('https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1350&q=80') center/cover;"></div>
                <div class="position-absolute start-0 top-0 w-100 h-100"></div>

                <h5 class="modal-title fs-5 fw-bold text-dark mb-0" style="z-index:1;">
                    Student Details
                </h5>
            </div>

            <div id="viewModalBody">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script>

    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#studentsBody tr');

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));

    function loadUpdateForm(id) {
        const container = document.getElementById('updateModalBody');
        container.innerHTML = `
            <div class="modal-body p-4">
                <div class="text-center">
                    <div class="spinner-border text-primary"></div>
                </div>
            </div>`;
        updateModal.show();

        fetch(`{{ url('/') }}/update-form/${id}`)
            .then(r => r.text())
            .then(html => {
                container.innerHTML = html;

                // Re-attach form submit after load
                const form = container.querySelector('form');
                if (form) {
                    form.addEventListener('submit', handleUpdateSubmit);
                }
            });
    }

    function handleUpdateSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const data = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message,
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        updateModal.hide();
                        location.reload();
                    });
                } else {
                    const errorMsg = Object.values(res.errors || {}).flat().join(', ');
                    Swal.fire('Oops!', errorMsg, 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error!', 'Something went wrong.', 'error');
            });
    }

    function deleteStudent(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('/') }}/list/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(r => r.json())
                    .then(res => {
                        if (res.success) {
                            // Remove row from table
                            document.querySelector(`tr[data-id="${id}"]`).remove();

                            // Show colored toast
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                background: '#28a745',
                                color: 'white',
                                iconColor: 'white'
                            });
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                        } else {
                            Swal.fire('Error!', res.message || 'Failed to delete.', 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    });
            }
        });
    }

    const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));

    function viewStudent(id) {
        const container = document.getElementById('viewModalBody');
        container.innerHTML = `
        <div class="modal-body p-4">
            <div class="text-center">
                <div class="spinner-border text-primary"></div>
            </div>
        </div>`;
        viewModal.show();

        fetch(`{{ url('/') }}/view-form/${id}`)
            .then(r => r.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(() => {
                container.innerHTML = '<p class="text-danger text-center">Failed to load.</p>';
            });
    }

</script>


</body>
</html>
