<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    @include('shared.teacher-nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Routine Schedule') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('classSchedule/store/'.$course->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration (in days)') }}</label>

                                <div class="col-md-6">
                                    <select id="duration" class="form-control" name="duration" onchange="generateScheduleFields(this.value)" required>
                                        <option value="">Select Duration</option>
                                        <option value="1">1 Day</option>
                                        <option value="2">2 Days</option>
                                    </select>
                                </div>
                            </div>

                            <div id="schedule_fields"></div>

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
        function generateScheduleFields(duration) {
            var scheduleFields = document.getElementById('schedule_fields');
            scheduleFields.innerHTML = '';

            if (duration > 0) {
                for (var i = 1; i <= duration; i++) {
                    var scheduleFieldGroup = document.createElement('div');
                    scheduleFieldGroup.className = 'form-group row';
                    scheduleFields.appendChild(scheduleFieldGroup);

                    var dayLabel = document.createElement('label');
                    dayLabel.className = 'col-md-4 col-form-label text-md-right';
                    dayLabel.textContent = 'Day ' + i + ' of Week';
                    scheduleFieldGroup.appendChild(dayLabel);

                    var dayInputDiv = document.createElement('div');
                    dayInputDiv.className = 'col-md-6';
                    scheduleFieldGroup.appendChild(dayInputDiv);

                    var dayInput = document.createElement('input');
                    dayInput.id = 'day_of_week_' + i;
                    dayInput.type = 'text';
                    dayInput.className = 'form-control';
                    dayInput.name = 'day_of_week_' + i;
                    dayInput.required = true;
                    dayInputDiv.appendChild(dayInput);

                    var startTimeLabel = document.createElement('label');
                    startTimeLabel.className = 'col-md-4 col-form-label text-md-right';
                    startTimeLabel.textContent = 'Start Time (Day ' + i + ')';
                    scheduleFieldGroup.appendChild(startTimeLabel);

                    var startTimeInputDiv = document.createElement('div');
                    startTimeInputDiv.className = 'col-md-6';
                    scheduleFieldGroup.appendChild(startTimeInputDiv);

                    var startTimeInput = document.createElement('input');
                    startTimeInput.id = 'start_time_' + i;
                    startTimeInput.type = 'text';
                    startTimeInput.className = 'form-control';
                    startTimeInput.name = 'start_time_' + i;
                    startTimeInput.required = true;
                    startTimeInputDiv.appendChild(startTimeInput);

                    var endTimeLabel = document.createElement('label');
                    endTimeLabel.className = 'col-md-4 col-form-label text-md-right';
                    endTimeLabel.textContent = 'End Time (Day ' + i + ')';
                    scheduleFieldGroup.appendChild(endTimeLabel);

                    var endTimeInputDiv = document.createElement('div');
                    endTimeInputDiv.className = 'col-md-6';
                    scheduleFieldGroup.appendChild(endTimeInputDiv);

                    var endTimeInput = document.createElement('input');
                    endTimeInput.id = 'end_time_' + i;
                    endTimeInput.type = 'text';
                    endTimeInput.className = 'form-control';
                    endTimeInput.name = 'end_time_' + i;
                    endTimeInput.required = true;
                    endTimeInputDiv.appendChild(endTimeInput);
                }
            }
        }
    </script>

</body>

</html>