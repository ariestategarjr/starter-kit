@extends('layouts.app.main')
@section('title')
    IMM - Starter Kit
@endsection

@section('content')
    <!--begin::Row-->
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
            <div class="card">
                {{-- <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Sales List</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary btn-sm">Kembali</button>
                        <ul class="nav" id="kt_chart_widget_8_tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-bs-toggle="tab" id="kt_chart_widget_8_week_toggle" href="#kt_chart_widget_8_week_tab" aria-selected="false" tabindex="-1" role="tab">Month</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active" data-bs-toggle="tab" id="kt_chart_widget_8_month_toggle" href="#kt_chart_widget_8_month_tab" aria-selected="true" role="tab">Week</a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Toolbar-->
                </div> --}}
                {{-- <div class="card-header">
                    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="card-title">
                                <h3>Sales List</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="card-title">
                                <button type="button" class="btn btn-secondary btn-sm">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6 required">Faktur</label>
                                <input class="form-control form-control-sm" type="text" name="invoice_code"
                                    autocomplete="off" value="{{ $invoice_code }}" id="invoice_code" readonly>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6 required">Tanggal</label>
                                <input class="form-control form-control-sm" type="text" name="date" autocomplete="off"
                                    value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6">Pelanggan</label>
                                {{-- <input class="form-control form-control-sm" type="text" name="sale_customer" autocomplete="off" value="" readonly> --}}
                                <div class="input-group mb-3">
                                    <input class="form-control form-control-sm" type="text" name="customer"
                                        autocomplete="off" value="-" readonly>
                                    <input type="hidden" name="kopel" id="kopel" value="0">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary" type="button" id="showCustomerModal">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6">Aksi</label>
                                <div class="input-group">
                                    <button class="btn btn-danger btn-sm" type="button" id="deleteSaleModal">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>&nbsp;
                                    <button class="btn btn-success btn-sm" type="button" id="saveSaleModal">
                                        <i class="fa fa-save"></i>
                                    </button>&nbsp;
                                    <button class="btn btn-primary btn-sm" type="button" id="reportSaleModal">
                                        {{-- <i class="fa fa-note"></i> --}}
                                        <span>Laporan</span>
                                    </button>&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6 required">Barcode</label>
                                <input class="form-control form-control-sm" type="text" name="barcode" id="barcode"
                                    value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6 required">Nama Produk</label>
                                <input class="form-control form-control-sm" type="text" name="product_name"
                                    id="product_name" value="-" autocomplete="off" value="" readonly>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6">Jumlah</label>
                                <input class="form-control form-control-sm" type="number" name="amount" id="amount"
                                    value="0" autocomplete="off" value="" readonly>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-6">Total Bayar</label>
                                <input type="text" class="form-control form-control-sm" name="total" id="total"
                                    style="text-align: right; color:blue; font-weight: bold; font-size: 25pt;"
                                    value="0" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3" id="showSaleDetailTable">
                            {{-- <div class="table-responsive text-nowrap">
                                <table class="table table-hover table-rounded table-striped border gy-2 gs-2"
                                    id="dataTable">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> --}}

                            {{-- showSaleDetailTable will be display in here --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Modal-->
    <div class="modal fade" id="productModal">
        @include('pages.sales.modals.product')
    </div>
    <!--end::Modal-->
@endsection

@push('script')
    <script>
        // function generateInvoiceCode() {
        //     let invoiceCode = `FS${new Date().getTime()}`;

        //     $('#invoice').val(invoiceCode);
        // }

        function checkBarcodeInput() {
            let barcode = $('#barcode').val();

            if (barcode.length === 0) {
                $.ajax({
                    url: "{{ route('sale.showProductsModal') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.modal) {
                            // $('#modal-container').html(response.modal).show();
                            $('#productModal').modal('show');
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(`${xhr.status} ${xhr.responseText} ${thrownError}`);
                    }
                });
            }
            // else {
            //     $.ajax({
            //         url: "{{ route('sale.storeSaleDetailTemp') }}",
            //         type: "POST",
            //         dataType: "json",
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             barcode: barcode,
            //             invoice_code: $('#invoice_code').val(),
            //             product_name: $('#product_name').val(),
            //             amount: $('#amount').val(),
            //         },
            //         success: function(response) {
            //             if (response.data === "many") {
            //                 $.ajax({
            //                     url: "{{ route('sale.showProductsModal') }}",
            //                     type: "POST",
            //                     dataType: "json",
            //                     data: {
            //                         _token: "{{ csrf_token() }}",
            //                         keyword: barcode,
            //                     },
            //                     success: function(response) {
            //                         if (response.modal) {
            //                             $('#productModal').modal('show');
            //                         }
            //                     },
            //                     error: function(xhr, thrownError) {
            //                         alert(`${xhr.status} ${xhr.responseText} ${thrownError}`);
            //                     }
            //                 });
            //             }
            //             // if (response.success) {
            //             // }
            //         }
            //     });
            // }
        }

        $(document).ready(function() {
            // generateInvoiceCode();

            $('#barcode').keydown(function(e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    checkBarcodeInput();
                }
            });
        });
    </script>
@endpush
