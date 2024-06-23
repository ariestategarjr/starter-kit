@extends('layouts.app.main')
@section('title')
    IMM - Starter Kit
@endsection
@section('content')
    <!-- Default box -->
    <!-- Main content -->
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-12">
                <!-- small box -->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10"
                    style="background-color: #000000 !important;)">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $dataCountProducts }}</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Produk</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            {{-- <div
                                class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>43 Pending</span>
                                <span>72%</span>
                            </div> --}}
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- small box -->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10"
                    style="background-color: #000000 !important;)">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $dataCountSales }}</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Penjualan</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            {{-- <div
                                class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>43 Pending</span>
                                <span>72%</span>
                            </div> --}}
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- small box -->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10"
                    style="background-color: #000000 !important;)">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $dataCountPurchases }}</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Pembelian</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            {{-- <div
                                class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>43 Pending</span>
                                <span>72%</span>
                            </div> --}}
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-row card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Stok Habis</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($dataEmptyStock as $row)
                            <div class="card card-danger card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $row->name }}</h5>
                                    <div class="card-tools">
                                        {{-- <a href="" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Barang Terlaris</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBestSeller as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->selling_price }}</td>
                                        <td>
                                            <strong class="text-success me-1">
                                                <i class="fas fa-arrow-up"></i>
                                                {{ $row->amount }}
                                            </strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-row card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Stok Habis</h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Biskuat 10gr</h5>
                                <div class="card-tools">
                                    <a href="http://localhost:8080/index.php/product/index" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Barang Terlaris</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Teh Gelas 250ml</td>
                                    <td>1000.00</td>
                                    <td>
                                        <strong class="text-success me-1">
                                            <i class="fas fa-arrow-up"></i>
                                            15.00
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Teh Gelas 180ml</td>
                                    <td>1000.00</td>
                                    <td>
                                        <strong class="text-success me-1">
                                            <i class="fas fa-arrow-up"></i>
                                            6.00
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div><!-- /.container-fluid -->

    <!-- /.content -->
    <!-- /.card -->


    {{-- <div class="py-5">
        <div class="row">
            <div class="col-md-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex align-items">
                        <i class="ki-duotone ki-rocket fs-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            Example link title
                        </span>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex align-items">
                        <i class="ki-duotone ki-timer fs-1"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            Example link title
                        </span>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex align-items">
                        <i class="ki-duotone ki-bucket fs-1"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span><span class="path4"></span></i>
                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            Example link title
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div> --}}



    {{-- <!-- Default box -->
    <!-- Main content -->
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>3</h3>

                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="http://localhost:8080/index.php/product/index" class="small-box-footer">Info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>6</h3>

                        <p>Penjualan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="http://localhost:8080/index.php/sale/report" class="small-box-footer">Info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Pembelian</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="http://localhost:8080/index.php/purchase/report" class="small-box-footer">Info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-row card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            Stok Habis
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Biskuat 10gr</h5>
                                <div class="card-tools">
                                    <a href="http://localhost:8080/index.php/product/index" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Barang Terlaris
                        </h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Teh Gelas 250ml</td>
                                    <td>1000.00</td>
                                    <td>
                                        <bold class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            15.00
                                        </bold>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Teh Gelas 180ml</td>
                                    <td>1000.00</td>
                                    <td>
                                        <bold class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            6.00
                                        </bold>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <!-- /.content -->
    <!-- /.card --> --}}
@endsection
