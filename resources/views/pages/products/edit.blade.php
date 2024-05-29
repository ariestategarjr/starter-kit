@extends('layouts.app.main')
@section('title')
    IMM - Starter Kit
@endsection
@section('content')
    <!--begin::Form-->
    {{-- <form method="POST" action="{{ route('product.update', [ 'id'=>$product->id ]) }}">
        <input class="form-control form-control-lg form-control-solid" type="text"
            placeholder="Masukan barcode" name="barcode" id="barcode" value="{{ $product->barcode }}" readonly/>
        <input class="form-control form-control-lg form-control-solid" type="text"
            placeholder="Masukan nama" name="name" value="{{ $product->name }}" autocomplete="off"/>
        <button type="submit" class="btn btn-lg btn-primary">
    </form>     --}}
    <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('product.update', [ 'id'=>$product->id ]) }}">
        @csrf
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-md-6">
                <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="row fv-row mb-12">
                                    <!--begin::Col-->
                                    <div class="col-xl-12">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Barcode</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Masukan barcode" name="barcode" id="barcode" value="{{ $product->barcode }}" readonly/>
                                        </div>
                                    <div class="col-xl-12">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Nama</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Masukan nama" name="name" value="{{ $product->name }}" autocomplete="off"/>
                                    </div>
                                    <div class="fv-row mb-5">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Unit</label>
                                        <select name="unit" id="unit" class="form-select form-select-lg form-select-solid">
                                            <option value="" disabled selected>Pilih Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ $unit->id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-5">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Kategori</label>
                                        <select name="category" id="category" class="form-select form-select-lg form-select-solid">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                                </option>
                                            @endforeach                                        
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
            
            <div class="col-md-6">
                <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-3 mb-md-5 mb-xl-10">
                        <!--begin::Input group-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row fv-row mb-12">
                                    <div class="col-xl-12">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Stok</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Masukan stok" name="stock" autocomplete="off" value="{{ $product->stock }}"/>
                                    </div>        
                                    <div class="col-xl-12">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Harga Beli</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Masukan harga beli" name="purchase_price" autocomplete="off" value="{{ $product->purchase_price }}"/>
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label fw-bolder text-dark fs-6 required">Harga Jual</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Masukan harga jual" name="selling_price" autocomplete="off" value="{{ $product->selling_price }}"/>
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
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </form>
    <!--end::Form-->
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