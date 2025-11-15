<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
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
                        <tr>
                            <td><strong>{{ $student->name }}</strong></td>
                            <td>
                                <small class='text-muted'>{{ $student->email }}</small><br>
                                Age: {{ $student->age }} | Course: {{ $student->course }}
                            </td>
                            <td class='text-center'>
                                <button class='btn btn-info btn-sm' title='View'>View</button>
                                <a href="{{route('edit',$student->id)}}" class='btn btn-warning btn-sm' title='Update'>Update</a>
                                <a href="{{route('delete',$student->id)}}" class='btn btn-danger btn-sm' title='Delete'>Delete</a>
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
        <div class="modal-content shadow-lg rounded-4 overflow-hidden">

            <div class="modal-header bg-gradient bg-primary text-white border-0 py-4 position-relative">
                <div class="position-absolute start-0 top-0 h-100 w-100 opacity-10">
                </div>
                <h5 class="modal-title fs-4 fw-bold align-self-center" id="registerModalLabel">
                    Student Registration
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 p-md-5 bg-light">
                @include('register')
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

</script>

</body>
</html>
