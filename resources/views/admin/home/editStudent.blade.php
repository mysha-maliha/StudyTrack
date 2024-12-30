<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Student</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    @include('shared.admin-nav')

    <div class="jumbotron">
        <form action="{{ url('admin/update-student/'.$student->id) }}" method="post">
            @csrf
            <h2>Edit Student</h2>
            <div class="form-group">
                <label for="name" class="text-info">Name:</label><br>
                <input type="text" name="name" value="{{ $student->name }}" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email" class="text-info">Email:</label><br>
                <input type="text" name="email" value="{{ $student->email }}" id="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Update">
            </div>
        </form>
    </div>

</body>

</html>