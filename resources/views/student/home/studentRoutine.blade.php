<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Routine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    @include('shared.student-nav')


    <div class="container">
        <h2>Class Routine</h2>

        @foreach ($routine as $key => $value)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ $key }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($value as $v)
                <tr>
                    <td>{{$v['courseName']}}</td>
                    <td>{{$v['startTime']}}</td>
                    <td>{{$v['endTime']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
</body>

</html>