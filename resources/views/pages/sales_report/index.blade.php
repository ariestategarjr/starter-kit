{{-- @dd($period_from); --}}

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
                <div class="card-header">
                    <div class="card-title">
                        <h1>Report Sales List</h1>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('sales_report.index') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label class="col-form-label">Periode</label>
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control" id="period_from" name="period_from" required>
                            </div>
                            <div class="col-auto">
                                -
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control" id="period_to" name="period_to" required>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12 col-md-3">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button onclick="printDiv('print-area')" class="btn btn-secondary buttons-print" tabindex="0"
                                aria-controls="example1" type="button"><span>Cetak</span></button>
                        </div>
                        <!-- <div class="dt-buttons btn-group flex-wrap">
                                                                                                                                                    <button class="btn btn-danger" type="button" onclick="deleteFilter()"><span>Delete Data</span></button>
                                                                                                                                                </div> -->
                    </div>

                    <div class="table-responsive text-nowrap">
                        {{-- <div class="col-sm-12" id="print-area"> --}}
                        <div class="col-sm-12" id="print-area">
                            <table class="table table-hover table-rounded table-striped border gy-7 gs-7" id="user_table">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                        <th>No</th>
                                        <th>No Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sale->invoice }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}</td>
                                            <td>{{ $sale->name }}</td>
                                            <td>{{ $sale->selling_price }}</td>
                                            <td>{{ $sale->amount }}</td>
                                            <td>{{ $sale->sub_total }}</td>
                                            {{-- <td class="text-uppercase">
                                        @if ($user->role->name == 'superadmin')
                                            <span class="badge badge-info rounded-pill">
                                                {{ $user->role->name }}
                                            </span>
                                        @elseif($user->role->name == 'admin')
                                            <span class="badge badge-primary rounded-pill">
                                                {{ $user->role->name }}
                                            </span>
                                        @elseif($user->role->name == 'user')
                                            <span class="badge badge-success rounded-pill">
                                                {{ $user->role->name }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary rounded-pill">
                                                {{ $user->role->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('DD MMM Y') }}</td> --}}
                                            {{-- <td>
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                                        class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @csrf
                                                    <a href="javascript:;"
                                                        onclick="handleDelete('{{ $product->name }}','{{ route('product.destroy', ['id' => $product->id]) }}')"
                                                        class="menu-link px-3"
                                                        data-kt-users-table-filter="delete_row">Delete</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <iframe id="printing-frame" name="print_frame" src="about:blank" style="display: none;"></iframe>
@endsection
@push('script')
    <script src="{{ asset('assets/plugins/custom/datatables-jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        function printDiv(elementId) {
            // console.log(document.getElementById(elementId));
            // let elementPrinted = document.getElementById(elementId);

            // console.log(elementPrinted);

            let elementPrinted = document.getElementById(elementId).innerHTML;

            window.frames["print_frame"].document.title = document.title;
            window.frames["print_frame"].document.body.innerHTML =
                `<style>
                .no-print { display: none }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {    
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                .dataTables_length,
                .dataTables_filter,
                .dataTables_info,
                .dataTables_paginate 
                {
                    display: none;
                }
            </style>
            ${elementPrinted}`;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#user_table').DataTable();
        });
    </script>
@endpush
