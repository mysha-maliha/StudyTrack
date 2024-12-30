<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    @include('shared.teacher-nav')

    <div class="container">
        <h2>Create Exam Schedule</h2>
        <form action="{{ url('/teacher/exam-store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="selectedCourse">Select Course</label>
                <select name="selectedCourse">
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>

                <label for="examType">Select Exam Type</label>
                <select name="examType">
                    <option value="CT">CT</option>
                    <option value="Mid">Mid</option>
                    <option value="Final">Final</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" id="">
            </div>

            <div class="form-group">
                <label for="startTime">Start Time</label>
                <input type="time" class="form-control" name="startTime" id="">
            </div>

            <div class="form-group">
                <label for="endTime">End Time</label>
                <input type="time" class="form-control" name="endTime" id="">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>

</body>

</html>