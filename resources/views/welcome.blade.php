<!DOCTYPE html>
<html>
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
<h3 style="padding-top: 200px; padding-bottom: 6px;">Booking Dokter Online</h3>
<h6 style="padding-bottom: 10px;">By abdurozzaq00@gmail.com</h6>

<div class="container" style="width: 600px;">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav flex-column nav-pills mb-auto">
                <li class="nav-item mb-4">
                    <a id="login" href="#" class="nav-link" aria-current="page">LOGIN</a>
                </li>
                <li class="nav-item mb-4">
                    <a id="register" href="#" class="nav-link">REGISTER</a>
                </li>
                <li class="nav-item mb-4">
                    <a id="patient-dashboard" href="#" class="nav-link">GO TO DASHBOARD</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>

<script>
    document.getElementById("login").onclick = function() {
        window.location.href = "/login";
    };

    document.getElementById("register").onclick = function() {
        window.location.href = "/register";
    };

    document.getElementById("patient-dashboard").onclick = function() {
        window.location.href = "/patient-dashboard";
    };
</script>

</html>
