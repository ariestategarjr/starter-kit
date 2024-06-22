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
                            <div class="col-auto">
                                <button onclick="print('print-area')" class="btn btn-secondary"
                                    type="button">Cetak</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12 col-md-3">
                        <div class="dt-buttons btn-group flex-wrap">

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
        function print(element) {
            // console.log(document.getElementById(elementId));
            // let elementPrinted = document.getElementById(elementId);

            // console.log(elementPrinted);

            let elementPrint = document.getElementById(element).innerHTML;

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
            ${elementPrint}`;
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
