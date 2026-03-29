<!-- Favicons -->
<link href="{{ asset('assets/admin/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

<!-- Flatpickr (date picker) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">

<style>
    /* Evenly aligned icon-only row actions in data tables */
    .table-action-btns {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        flex-wrap: nowrap;
    }
    .btn.btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.125rem;
        height: 2.125rem;
        padding: 0;
        line-height: 1;
    }
    .btn.btn-icon i {
        font-size: 1.05rem;
        line-height: 1;
    }
</style>

@stack('styles')
