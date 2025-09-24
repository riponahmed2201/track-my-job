<!-- Vendor JS Files -->
<script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/admin/js/main.js') }}"></script>

<script>
    // logout.js
    document.addEventListener("DOMContentLoaded", function() {
        const logoutLink = document.getElementById("logout-link");
        const logoutForm = document.getElementById("logout-form");

        if (logoutLink && logoutForm) {
            logoutLink.addEventListener("click", function(event) {
                event.preventDefault();
                logoutForm.submit();
            });
        }
    });
</script>

@stack('scripts')
