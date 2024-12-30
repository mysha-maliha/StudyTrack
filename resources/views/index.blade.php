<!DOCTYPE html>
<html lang="en">

<head>
    <title>StudyTrack - Index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="jumbotron text-center">
        <h1>StudyTrack</h1>
        <p>Navigate to your desired role</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3><a href="{{ url('/admin/login') }}">Admin</a></h3>
                <p>Head over to admin panel</p>
                <p>Manage users and courses</p>
            </div>
            <div class="col-sm-4">
                <h3><a href="{{ url('/teacher/login') }}">Teacher</a></h3>
                <p>Head over to teacher panel</p>
                <p>Manage schedules, attendances, assignments and remarks</p>
            </div>
            <div class="col-sm-4">
                <h3><a href="{{ url('/student/login') }}">Student</a></h3>
                <p>Head over to student panel</p>
                <p>Enroll courses, view schedules, submit assignments and check remarks</p>
            </div>
        </div>
    </div><br><br>

    @include('shared.footer')

</body>

</html>