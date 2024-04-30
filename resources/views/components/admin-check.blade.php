<script>
    $(document).ready(function() {
        var accessToken = localStorage.getItem('access_token');
        if (!accessToken) {
            window.location.href = '/login';
        } else {
            $.ajax({
                url: '/api/auth/me',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken
                },
                success: function(response) {
                    if (response.is_admin === "0") {
                        window.location.href = '/patient-dashboard';
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Pastikan anda sudah login.');
                    window.location.href = '/login';
                }
            });
        }
    });
</script>
