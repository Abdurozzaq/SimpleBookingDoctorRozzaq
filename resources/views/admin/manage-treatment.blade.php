<head>
    <title>Booking Doctor</title>
    @include('components.import')
</head>
<body style="text-align: center;">
@include('components.back-button-admin')
<h3 style="padding-bottom: 6px;">(ADMIN) Booking Dokter Online</h3>
<h6 style="padding-bottom: 10px;">Manage Treatment</h6>

<div class="container" style="width: 600px;">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="openModal">
                Create New Data
            </button>
            <table class="table table-bordered" id="y_dataTables">
                <thead class="pt-2">
                    <tr>
                        <th></th>
                        <th>Name</th>
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
            <form id="editForm">
                <div class="modal-body">
                    <input type="hidden" id="edit-id">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" class="form-control" id="edit-name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="$('#editModal').modal('hide');" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Data</h5>
                <button onclick="$('#createModal').modal('hide');" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="$('#createModal').modal('hide');" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
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
                "url": "/api/treatment",
                "dataType": 'json',
                "headers": {
                    "Authorization": 'Bearer ' + localStorage.getItem('access_token'),
                },
            },
            columns: [
                { data: 'id', name: 'id', visible: false },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Edit
        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            $.ajax({
                url: "/api/treatment/" + id,
                type: "GET", // Explicitly define GET method
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                },
                success: function (data) {
                    // Input validation (optional but recommended)
                    if (!data.id || !data.name) {
                        console.error("Incomplete treatment data received from API");
                        return;
                    }

                    $('#editModal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-name').val(data.name);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Failed to retrieve treatment data:", textStatus, errorThrown);
                    // Optional: Show user-friendly error message in the modal
                }
            });
        });

        // Submit form edit
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            var id = $('#edit-id').val();
            var name = $('#edit-name').val();
            $.ajax({
                type: "PUT",
                url: "/api/treatment/"+id,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                },
                data: { 'name': name },
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

        $('#openModal').on('click', function () {
            $('#createModal').modal('show');
        });

        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            var name = $('#name').val();
            $.ajax({
                type: "POST",
                url: "/api/treatment",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                },
                data: { 'name': name },
                success: function (data) {
                    $('#createModal').modal('hide');
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
                url: "/api/treatment/"+id,
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

