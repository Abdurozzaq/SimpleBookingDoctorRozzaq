<head>
    <title>Booking Doctor</title>
    @include('components.import')

    <style>
        .nav-pills {
            /* Tambahkan jarak antar tombol */
            margin-bottom: 8px;
        }

        .nav-link {
            /* Atur warna dan style */
            background-color: #eee;
            color: #000;
            border-radius: 5px;
            padding: 10px 16px;
        }

        .nav-link.active {
            /* Style untuk tombol aktif */
            background-color: #ccc;
            font-weight: bold;
        }
    </style>
</head>
<body style="text-align: center;">
<h3 style="padding-top: 200px; padding-bottom: 6px;">(ADMIN) Booking Dokter Online</h3>
<h6 style="padding-bottom: 10px;">By abdurozzaq00@gmail.com</h6>

<div class="container" style="width: 600px;">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav flex-column nav-pills mb-auto">
                <li class="nav-item mb-4">
                    <a id="manage-booking" href="#" class="nav-link" aria-current="page">MANAGE BOOKING</a>
                </li>
                <li class="nav-item mb-4">
                    <a id="manage-treatment" href="#" class="nav-link" aria-current="page">MANAGE TREATMENT</a>
                </li>
                <li class="nav-item mb-4">
                    <a id="manage-doctor" href="#" class="nav-link">MANAGE DOCTOR</a>
                </li>
                <li class="nav-item mb-4">
                    <a id="logout" href="#" class="nav-link">LOGOUT</a>
                </li>
            </ul>
        </div>
    </div>
</div>

@include('components.admin-check')
</body>

<script>
    document.getElementById("manage-booking").onclick = function() {
        window.location.href = "/manage-booking";
    };

    document.getElementById("manage-treatment").onclick = function() {
        window.location.href = "/manage-treatment";
    };

    document.getElementById("manage-doctor").onclick = function() {
        window.location.href = "/manage-doctor";
    };

    document.getElementById("logout").onclick = function() {
        window.location.href = "/logout";
    };
</script>

</html>

