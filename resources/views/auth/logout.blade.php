<!-- Di view Anda -->
<!DOCTYPE html>
<html>
<head>
    <title>Logging Out</title>
    @include('components.import')
</head>


<body>
<h1>Logging out...</h1>
<script>
    $(document).ready(function() {
        var accessToken = localStorage.getItem('access_token');
        if (!accessToken) {
            window.location.href = '/login';
        } else {
            $.ajax({
                url: '/api/auth/logout',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken
                },
                success: function(response) {
                    window.location.href = '/login';
                },
                error: function() {
                    alert('Terjadi kesalahan');
                    window.location.href = '/login';
                }
            });
        }
    });
</script>

</body>
</html>
