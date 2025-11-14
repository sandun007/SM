<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List Update</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body class="bg-light">

@include('component.navbar')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-black text-white text-center">
                    <h4>Student Update</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$student->id}}">
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$student->name}}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$student->email}}" required>
                        </div>
                        <div class="mb-4">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{$student->age}}" required>
                        </div>
                        <div class="mb-4">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course" name="course" value="{{$student->course}}" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script href="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
