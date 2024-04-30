<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="successToast toast hide text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Message</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Success to save data to database!
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="failedToast" class="failedToast toast hide text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Message</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Failed to save data to database!
        </div>
    </div>
</div>

<button class="d-none" type="button" id="failedToastBtn">failedToastBtn</button>
<button class="d-none" type="button" id="successToastBtn">successToastBtn</button>

<script>
    document.getElementById("failedToastBtn").onclick = function() {
        var toastElList = [].slice.call(document.querySelectorAll('.failedToast'))
        var toastList = toastElList.map(function(toastEl) {
            // Creates an array of toasts (it only initializes them)
            return new bootstrap.Toast(toastEl, {
                delay: 10000
            })
        });
        toastList.forEach(toast => toast.show()); // This shows them
    };

    document.getElementById("successToastBtn").onclick = function() {
        var toastElList = [].slice.call(document.querySelectorAll('.successToast'))
        var toastList = toastElList.map(function(toastEl) {
            // Creates an array of toasts (it only initializes them)
            return new bootstrap.Toast(toastEl, {
                delay: 10000
            })
        });
        toastList.forEach(toast => toast.show()); // This shows them
    };
</script>
