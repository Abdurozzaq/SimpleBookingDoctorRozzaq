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
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan konfirmasi password">
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

            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var password_confirmation = $("#password_confirmation").val();

            $.ajax({
                url: "/api/auth/register",
                method: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                },
                success: function(response) {
                    // Login berhasil, simpan access_token
                    alert("Register Berhasil! Silahkan Login.")
                    window.location.href = "{{ route('login') }}";
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
