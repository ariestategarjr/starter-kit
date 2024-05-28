@extends('layouts.app.main')
@section('title')
    IMM - Starter Kit
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('category.update', ['id' => $category->id]) }}">
                @csrf
                
                <!--begin::Input group-->
                <div class="card">
                    <div class="card-body">
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="col-xl-12">
                                <label class="form-label fw-bolder text-dark fs-6 required">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $category->name }}">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
            
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                                {{-- <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> --}}
                            </button>
                        </div>
                    </div>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
@endsection
@push('script')
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
    <script>
        const keySuccess = @json(session('success'));
        const keyErrors = @json(session('errors'));
        const keyError = @json(session('error'));
        if (keySuccess) {
            Swal.fire({
                title: 'Berhasil',
                text: keySuccess,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-success"
                }
            });
        }
        if (keyErrors) {
            Swal.fire({
                title: 'Gagal',
                text: 'Gagal membuat user pastikan semua form sudah terisi!',
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        }
        if (keyError) {
            Swal.fire({
                title: 'Gagal',
                text: keyError,
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        }
    </script>
@endpush
