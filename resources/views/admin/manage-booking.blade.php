<head>
    <title>Booking Doctor</title>
    @include('components.import')
</head>
<body style="text-align: center;">
@include('components.back-button-admin')
<h3 style="padding-bottom: 6px;">(ADMIN) Booking Dokter Online</h3>
<h6 style="padding-bottom: 10px;">Manage Booking Doctor</h6>

<div class="container" style="width: 600px;">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="y_dataTables">
                <thead class="pt-2">
                    <tr>
                        <th></th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Treatment</th>
                        <th>Datetime</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button onclick="$('#editModal').modal('hide');" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" class="mt-2 mx-5 mb-5">
                <input type="hidden" name="edit-id" id="edit-id">
                <div class="form-group mb-3">
                    <label for="edit-patient">Patient</label>
                    <select disabled class="form-control" name="edit-patient" id="edit-patient">
                        <!-- Opsi akan diisi oleh jQuery -->
                    </select>
                    <span id="treatmentError" class="text-danger"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="edit-treatment">Treatment</label>
                    <select class="form-control" name="edit-treatment" id="edit-treatment">
                        <!-- Opsi akan diisi oleh jQuery -->
                    </select>
                    <span id="treatmentError" class="text-danger"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="edit-doctor">Doctor</label>
                    <select class="form-control" name="edit-doctor" id="edit-doctor">
                        <!-- Opsi akan diisi oleh jQuery -->
                    </select>
                    <span id="doctorError" class="text-danger"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="edit-booking-datetime">Date Time</label>
                    <input type="datetime-local" class="form-control" name="edit-booking-datetime" id="edit-booking-datetime">
                    <span id="datetimeError" class="text-danger"></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@include('components.alert')
@include('components.admin-check')

<script>
    $(document).ready( function () {
        var failedToastButtonTrigger = document.getElementById('failedToastBtn');
        var successToastButtonTrigger = document.getElementById('successToastBtn');

        $('#y_dataTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "/api/bookingdoctor",
                "dataType": 'json',
                "headers": {
                    "Authorization": 'Bearer ' + localStorage.getItem('access_token'),
                },
            },
            columns: [
                { data: 'id', name: 'id', visible: false },
                { data: 'patient_name', name: 'patient' },
                { data: 'doctor_name', name: 'doctor' },
                { data: 'treatment_name', name: 'treatment' },
                { data: 'booking_datetime', name: 'booking_datetime' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Fungsi untuk mengambil data dan memasukkannya ke dalam select option
        function fetchData(url, elementId, valueId) {
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                },
                success: function(data) {
                    console.log(data);
                    var select = $(`#${elementId}`);
                    select.empty();
                    for (let i = 0; i < data.length; i++) {
                        let value = data[i];
                        select.append(`<option ${valueId === value.id ? 'selected ' : ''} value="${value.id}">${value.name}</option>`);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Edit
        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            $.ajax({
                url: "/api/bookingdoctor/" + id,
                type: "GET", // Explicitly define GET method
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                },
                success: function (data) {
                    $('#editModal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-patient-id').val(data.patient_id);
                    $('#edit-doctor-id').val(data.doctor_id);
                    $('#edit-treatment-id').val(data.treatment_id);
                    $('#edit-booking-datetime').val(data.booking_datetime);

                    // Panggil fungsi untuk setiap select option
                    fetchData('/api/booking/treatment', 'edit-treatment', data.treatment_id);
                    fetchData('/api/booking/doctor', 'edit-doctor', data.doctor_id);
                    fetchData('/api/booking/patient', 'edit-patient', data.patient_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Failed to retrieve bookingdoctor data:", textStatus, errorThrown);
                    // Optional: Show user-friendly error message in the modal
                }
            });
        });

        // Submit form edit
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            var id = $('#edit-id').val();
            var doctor_id = $('#edit-doctor').val();
            var patient_id = $('#edit-patient').val();
            var treatment_id = $('#edit-treatment').val();
            var booking_datetime = $('#edit-booking-datetime').val();
            $.ajax({
                type: "PUT",
                url: "/api/bookingdoctor/"+id,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                },
                data: {
                    'id': id,
                    'doctor_id': doctor_id,
                    'patient_id': patient_id,
                    'treatment_id': treatment_id,
                    'booking_datetime': booking_datetime,
                },
                success: function (data) {
                    $('#editModal').modal('hide');
                    successToastButtonTrigger.click();
                    $('#y_dataTables').DataTable().draw();
                },
                error: function (data) {
                    failedToastButtonTrigger.click();
                    console.log('Error:', data);

                    if (data.responseJSON.message === "This action is unauthorized.") {
                        window.location.href = '/logout';
                    }
                }
            });
        });

        // Delete
        $('body').on('click', '.delete', function () {
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                url: "/api/bookingdoctor/"+id,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                },
                success: function (data) {
                    successToastButtonTrigger.click();
                    $('#y_dataTables').DataTable().draw();
                },
                error: function (data) {
                    failedToastButtonTrigger.click();
                    console.log('Error:', data);

                    if (data.responseJSON.message === "This action is unauthorized.") {
                        window.location.href = '/logout';
                    }
                }
            });
        });
    });
</script>
</body>
</html>

