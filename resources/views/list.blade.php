<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body class="bg-light">

@include('component.navbar')

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div class="flex-grow-1 text-center">
                <h4 class="mb-0">Registered Students</h4>
            </div>
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

<script href="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

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
