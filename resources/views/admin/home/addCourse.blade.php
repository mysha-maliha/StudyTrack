<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    @include('shared.admin-nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Course') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('courses/store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="number_of_courses" class="col-md-4 col-form-label text-md-right">{{ __('Number of Courses') }}</label>

                                <div class="col-md-6">
                                    <select id="number_of_courses" class="form-control" name="number_of_courses" onchange="generateCourseFields(this.value)" required>
                                        <option value="">Select Number of Courses</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>

                            <div id="course_fields"></div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateCourseFields(numberOfCourses) {
            var courseFields = document.getElementById('course_fields');
            courseFields.innerHTML = '';

            if (numberOfCourses > 0) {
                for (var i = 1; i <= numberOfCourses; i++) {
                    var courseFieldGroup = document.createElement('div');
                    courseFieldGroup.className = 'form-group row';
                    courseFields.appendChild(courseFieldGroup);

                    var titleLabel = document.createElement('label');
                    titleLabel.className = 'col-md-4 col-form-label text-md-right';
                    titleLabel.textContent = 'Course ' + i + ' Title';
                    courseFieldGroup.appendChild(titleLabel);

                    var titleInputDiv = document.createElement('div');
                    titleInputDiv.className = 'col-md-6';
                    courseFieldGroup.appendChild(titleInputDiv);

                    var titleInput = document.createElement('input');
                    titleInput.id = 'course_title_' + i;
                    titleInput.type = 'text';
                    titleInput.className = 'form-control';
                    titleInput.name = 'course_title_' + i;
                    titleInput.required = true;
                    titleInputDiv.appendChild(titleInput);

                    var descriptionLabel = document.createElement('label');
                    descriptionLabel.className = 'col-md-4 col-form-label text-md-right';
                    descriptionLabel.textContent = 'Course ' + i + ' Description';
                    courseFieldGroup.appendChild(descriptionLabel);

                    var descriptionInputDiv = document.createElement('div');
                    descriptionInputDiv.className = 'col-md-6';
                    courseFieldGroup.appendChild(descriptionInputDiv);

                    var descriptionInput = document.createElement('textarea');
                    descriptionInput.id = 'course_description_' + i;
                    descriptionInput.className = 'form-control';
                    descriptionInput.name = 'course_description_' + i;
                    descriptionInput.required = true;
                    descriptionInputDiv.appendChild(descriptionInput);
                }
            }
        }
    </script>
</body>

</html>