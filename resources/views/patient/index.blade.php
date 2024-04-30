<!-- Di view Anda -->
<!DOCTYPE html>
<html>
<head>
    <title>Patient Dash</title>
    @include('components.import')
</head>


<body style="text-align: center;">
@include('components.logout-button')
<h3 style="padding-bottom: 6px;">Booking Dokter Online</h3>
<h5 id="access_name"></h5>

<div class="container" style="width: 600px;">
    <div class="row">
        <div class="col-md-12">
            <form id="ajaxForm" class="mt-5">
                <div class="form-group mb-3">
                    <label for="treatment">Treatment</label>
                    <select class="form-control" name="treatment" id="treatment">
                        @foreach($treatments as $treatment)
                            <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                        @endforeach
                    </select>
                    <span id="treatmentError" class="text-danger"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="doctor">Doctor</label>
                    <select class="form-control" name="doctor" id="doctor">
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->specialization }}</option>
                        @endforeach
                    </select>
                    <span id="doctorError" class="text-danger"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="datetime">Date Time</label>
                    <input type="datetime-local" class="form-control" name="datetime" id="datetime">
                    <span id="datetimeError" class="text-danger"></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@include('components.alert')
@include('components.patient-check')

<script>
    $(document).ready(function() {
        $('#access_name').text(localStorage.getItem('access_name'));
    });

    var failedToastButtonTrigger = document.getElementById('failedToastBtn');
    var successToastButtonTrigger = document.getElementById('successToastBtn');

    $("#ajaxForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/api/booking-doctor',
            type: 'post',
            data: $("#ajaxForm").serialize(),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            success: function(response){
                successToastButtonTrigger.click();
                $("#ajaxForm")[0].reset();
            },
            error: function(error){
                if(error.status === 422) {
                    var errors = error.responseJSON.errors;
                    $('#treatmentError').text(errors.treatment ? errors.treatment[0] : '');
                    $('#doctorError').text(errors.doctor ? errors.doctor[0] : '');
                    $('#datetimeError').text(errors.datetime ? errors.datetime[0] : '');
                }
                failedToastButtonTrigger.click();
            }
        });
    });
</script>
</body>
</html>
