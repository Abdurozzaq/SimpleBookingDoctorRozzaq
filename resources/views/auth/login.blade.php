<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @include('components.import')
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitButton">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#loginForm").submit(function(e) {
            e.preventDefault();

            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                url: "/api/auth/login",
                method: "POST",
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    if (response.access_token) {
                        $.ajax({
                            url: '/api/auth/me',
                            method: 'POST',
                            headers: {
                                'Authorization': 'Bearer ' + response.access_token
                            },
                            success: function(response) {
                                localStorage.setItem('access_name', response.name);
                            },
                            error: function() {
                                alert(response.message);
                            }
                        });

                        // Login berhasil, simpan access_token
                        localStorage.setItem('access_token', response.access_token);
                        window.location.href = "{{ route('patient-dashboard') }}";
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>

@csrf
</body>
</html>
