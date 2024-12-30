<!DOCTYPE html>
<html lang="en">

<head>
    <title>Exam Schedule</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    @include('shared.student-nav')

    <div class="container">
        <h2>Exam Schedule</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routine as $r)
                <tr>
                    <td>{{ $r['course_name'] }}</td>
                    <td>{{ $r['exam_type'] }}</td>
                    <td>{{ $r['date'] }}</td>
                    <td>{{ $r['start_time'] }}</td>
                    <td>{{ $r['end_time'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

</body>

</html>