@extends('admin.master')


@section('title', 'Admin Dashboard')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">

                        <!-- Vehicle Types Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Applied <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-car-front"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>2</h6>
                                            <span class="text-success small pt-1 fw-bold">1</span>
                                            <span class="text-muted small pt-2 ps-1">active</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Vehicle Types Card -->

                        <!-- Destinations Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Interview <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>1</h6>
                                            <span class="text-success small pt-1 fw-bold">1</span>
                                            <span class="text-muted small pt-2 ps-1">active</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Destinations Card -->

                        <!-- Pricing Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Offer <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>1</h6>
                                            <span class="text-success small pt-1 fw-bold">1</span>
                                            <span class="text-muted small pt-2 ps-1">active</span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End Pricing Card -->
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <!-- Booking Request -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Recent Apply Job</h5>

                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Job Position</th>
                                                    <th>Company Name</th>
                                                    <th>Max. Salary</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th>Date Saved</th>
                                                    <th>Deadline</th>
                                                    <th>Date Applied</th>
                                                    <th>Follow up</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        {{-- {{ $bookings->links('pagination::bootstrap-4') }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Booking Request -->
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
