@extends('layouts.app.main')
@section('title')
    IMM - Starter Kit
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="py-3 mb-4 fw-bold">
            {{-- <span class="text-muted fw-light">Transaksi Penjualan /</span> --}}
            Order Berjalan
        </h5>
        <!-- Basic Bootstrap Table -->
        <div class="mt-3 card">
            <h1 class="mt-2 mb-3 card-header ms-3">Order Berjalan
                {{-- <a href="{{ route('customer-service.create') }}"
                    class="mt-4 btn btn-primary float-sm-end float-center mt-sm-0">
                    <i class="mdi mdi-plus me-2"></i>
                    Buat Order
                </a> --}}
                <button type="button" class="mt-2 btn btn-primary float-center float-sm-end mt-sm-0" data-bs-toggle="modal"
                    data-bs-target="#addNewCustomerModal">
                    <i class="mdi mdi-plus me-2"></i> Buat Order
                </button>
            </h1>
            <div class="px-4 pt-0 card-datatable table-responsive text-nowrap">
                <table class="table datatables-basic table-bordered">
                    <thead class="table-light">
                        <th></th>
                        <th>Menu</th>
                        <th>No Order</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        {{-- <th>Alamat</th> --}}
                        <th>Status Order</th>
                        <th>Order Dibuat</th>
                        <th>Deadline</th>
                        <th>CS ke Designer</th>
                        <th>Designer ke Printing</th>
                        <th>Designer ke Finishing</th>
                        <th>Printing ke Finishing</th>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- @foreach ($customer_services as $item) --}}
                            <tr>
                                <td>

                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="p-0 btn dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="mdi mdi-menu text-info"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- {{ route('customer-service.show', ['id' => $item->id]) }} --}}
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="">
                                                <i class="mdi mdi-eye me-2 text-info"></i> Lihat
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center "
                                                href="">
                                                <i class="mdi mdi-pencil-outline me-2 text-success"></i> Edit
                                            </a>
                                            {{-- onclick="confirmCancel('{{ $item->id }}', '{{ route('customer-service.update_status', ['customer_service_id' => $item->id, 'status' => 'Cancel']) }}')" --}}
                                            <a class="dropdown-item d-flex align-items-center "
                                                href="javascript:void(0);">
                                                <i class="mdi mdi-close-thick me-2 text-danger"></i>
                                                Cancel
                                            </a>
                                            {{-- <a href="{{ route('customer-service.update_status', ['customer_service_id' => $item->id, 'status' => 'Designer']) }}"
                                                class="dropdown-item d-flex align-items-center " onclick="successAlert()"
                                                id="success_alert">
                                                <i class="mdi mdi-chevron-right scaleX-n1-rtl me-2 text-primary"></i>Send
                                                Designer
                                            </a> --}}
                                            {{-- <a href="{{ route('logistic.update_status', ['customer_service_id' => $item->id, 'status' => 'Done']) }}"
                                                class="dropdown-item d-flex align-items-center">
                                                <i class="mdi mdi-chevron-right scaleX-n1-rtl me-2 text-success"></i>
                                                Done
                                            </a> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- <a href="{{ route('customer-service.show', ['id' => $item->id]) }}"
                                        class="text-primary">
                                        <strong>{{ $item->order_number }}</strong>
                                    </a> --}}
                                </td>
                                <td>
                                    {{-- {{ $item->name }} --}}
                                </td>
                                <td>
                                    {{-- {{ $item->phone }} --}}
                                </td>
                                <td>
                                    {{-- @if ($item->order_status == 'CS')
                                        {!! "<span class='badge bg-label-warning'>$item->order_status</span>" !!}
                                    @elseif($item->order_status == 'Designer')
                                        {!! "<span class='badge bg-label-info'>$item->order_status</span>" !!}
                                    @else
                                        {{ $item->order_status }}
                                    @endif --}}
                                    {{-- {!! $item->order_status == 'CS'
                                        ? '<span class="badge rounded-pill bg-label-primary"> CS </span>'
                                        : "<span class='badge rounded-pill bg-label-info'>$item->order_status</span>" !!} --}}
                                </td>
                                <td>
                                    {{-- {{ $item->created_at->isoFormat(' D MMM Y') }} --}}
                                </td>
                                <td>
                                    <b>
                                        {{-- {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->isoFormat(' D MMM Y') : ' - ' }} --}}
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        {{-- @if ($item->designer_created_at)
                                            {{ $item->created_at->diff($item->designer_created_at)->format('%d Hari') }}
                                        @else
                                            -
                                        @endif --}}
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        {{-- @if ($item->designer_created_at && $item->printing_created_at)
                                            {{ \Carbon\Carbon::parse($item->designer_created_at)->diff(\Carbon\Carbon::parse($item->printing_created_at))->format('%d Hari') }}
                                        @else
                                            -
                                        @endif --}}
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        {{-- @if ($item->designer_created_at && $item->finishing_created_at)
                                            {{ \Carbon\Carbon::parse($item->designer_created_at)->diff(\Carbon\Carbon::parse($item->finishing_created_at))->format('%d Hari') }}
                                        @else
                                            -
                                        @endif --}}
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        {{-- @if ($item->printing_created_at && $item->finishing_created_at)
                                            {{ \Carbon\Carbon::parse($item->printing_created_at)->diff(\Carbon\Carbon::parse($item->finishing_created_at))->format('%d Hari') }}
                                        @else
                                            -
                                        @endif --}}
                                    </b>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

        <!-- Add New Customer Order Modal -->
        <div class="modal fade" id="addNewCustomerModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple">
                <div class="p-3 modal-content p-md-5">
                    <div class="modal-body p-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="mb-4 text-center">
                            <h3 class="pb-1 mb-2">Transaksi Penjualan</h3>
                        </div>
                        {{-- {{ route('customer-service.store') }} --}}
                        <form action="{{ route('sale.store') }}" method="POST" class="needs-validation">
                            @csrf
                            <!--begin::Input group-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row fv-row mb-12">
                                        <!--begin::Col-->
                                        <div class="col-xl-12">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Nomor Faktur</label>
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                placeholder="Masukkan Nomor Faktur" name="invoice_code" id="invoice_code" readonly/>
                                            </div>
                                        <div class="col-xl-12">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Tanggal</label>
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                placeholder="Masukan tanggal" name="date" autocomplete="off" id="date" readonly/>
                                        </div>
                                        <div class="fv-row mb-5">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Pelanggan</label>
                                            <select name="customer" id="customer" class="form-select form-select-lg form-select-solid">
                                                <option value="" disabled selected>Pilih Pelanggan</option>
                                                <option value="" selected>-</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                        
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
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add New Customer Order Modal -->
    </div>
@endsection

@push('script')
<script>
    function generateInvoiceCodeAndDate() {
        let invoiceCode = `SI${Date.now()}`;
        $("#invoice_code").val(invoiceCode);
    }

    function generateDate() {
        const date = new Date();
        const formattedDate = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
        $("#date").val(formattedDate);
    }

    $(document).ready(function() {
        generateInvoiceCodeAndDate();
        generateDate();
    });
</script>
@endpush

