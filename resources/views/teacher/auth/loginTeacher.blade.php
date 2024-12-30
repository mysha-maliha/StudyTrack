<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="/">StudyTrack</a>
    </nav>

    <div id="login">
        <h3 class="text-center text-white pt-5">Login Form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ url('/teacher/user-login') }}" method="post">
                            @csrf
                            <h3 class="text-center text-info">Teacher Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="{{ url('teacher/register') }}" class="text-info">Register here</a>
                                <a href="{{ url('/student/login') }}" class="text-info">Student panel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>

</html>