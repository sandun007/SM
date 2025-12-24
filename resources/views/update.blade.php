<!DOCTYPE html>
<html lang="en">

<body class="bg-light">
    <div class="modal-body p-4 p-md-5 bg-light">

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
            <div class="modal-footer bg-light border-0 px-0 pt-4 mt-4 justify-content-between">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning">Update Student</button>
            </div>
        </form>
    </div>
</body>
</html>
