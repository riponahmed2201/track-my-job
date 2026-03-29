<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/php-email-form/validate.js') }}"></script>

<!-- Flatpickr (date picker) -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

        // Flatpickr: init on all .flatpickr-date inputs
        if (typeof flatpickr !== 'undefined') {
            document.querySelectorAll('.flatpickr-date').forEach(function(el) {
                flatpickr(el, {
                    dateFormat: 'Y-m-d',
                    allowInput: true,
                    altInput: true,
                    altFormat: 'M j, Y',
                });
            });
        }

        // Select2: init on all select elements
        if (typeof jQuery !== 'undefined' && jQuery.fn.select2) {
            jQuery('select.form-select, select.form-control').select2({
                theme: 'bootstrap-5',
                width: '100%',
                allowClear: true,
                placeholder: function() { return jQuery(this).data('placeholder') || 'Select...'; }
            });
        }
    });
</script>

@stack('scripts')
