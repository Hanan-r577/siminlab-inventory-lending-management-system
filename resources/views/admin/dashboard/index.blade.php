@extends('admin.layouts.app')


{{-- CSS --}}

@section('css')
@endsection



{{-- Konten Utama --}}

@section('content')
    <div class="row">

        {{-- Total Siswa --}}

        <div class="col-lg-4">

            <div class="card">

                <div class="card-body">

                    <div class="row align-items-start">

                        <div class="col-8">

                            <h5 class="card-title mb-9 fw-semibold"> Total Siswa </h5>

                            <h4 class="fw-semibold mb-3">{{ $total_siswa }}</h4>

                        </div>

                        <div class="col-4">

                            <div class="d-flex justify-content-end">

                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">

                                    <i class="ti ti-users fs-6"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Total Item --}}

        <div class="col-lg-4">

            <div class="card">

                <div class="card-body">

                    <div class="row align-items-start">

                        <div class="col-8">

                            <h5 class="card-title mb-9 fw-semibold"> Total Item </h5>

                            <h4 class="fw-semibold mb-3">{{ $total_item }}</h4>

                        </div>

                        <div class="col-4">

                            <div class="d-flex justify-content-end">

                                <div
                                    class="text-white bg-primary rounded-circle p-6 d-flex align-items-center justify-content-center">

                                    <i class="ti ti-box fs-6"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Total Pinjaman --}}

        <div class="col-lg-4">

            <div class="card">

                <div class="card-body">

                    <div class="row align-items-start">

                        <div class="col-8">

                            <h5 class="card-title mb-9 fw-semibold"> Total Pinjaman </h5>

                            <h4 class="fw-semibold mb-3">{{ $total_loan }}</h4>

                        </div>

                        <div class="col-4">

                            <div class="d-flex justify-content-end">

                                <div
                                    class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">

                                    <i class="ti ti-alarm fs-6"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection



{{-- JavaScript --}}

@section('js')
@endsection
