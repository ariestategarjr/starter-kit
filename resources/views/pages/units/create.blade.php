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
            <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('unit.store') }}">
                @csrf
                <!--begin::Input group-->
                <div class="card">
                    <div class="card-body">
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="col-xl-12">
                                <label class="form-label fw-bolder text-dark fs-6 required">Nama</label>
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    placeholder="Masukan nama" name="name" autocomplete="off" />
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