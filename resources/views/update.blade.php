<!DOCTYPE html>
<html lang="en">

<body class="bg-light">

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

</body>
</html>
