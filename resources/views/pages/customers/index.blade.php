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
                        <h1>Customer List</h1>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('customer.create') }}" class="btn btn-light-primary mb-10">
                        <i class="la la-plus"></i>
                        Add Customer
                    </a>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7" id="user_table">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>
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
                                                    <a href="{{ route('customer.edit', ['id' => $customer->id]) }}"
                                                        class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @csrf
                                                    <a href="javascript:;"
                                                        onclick="handleDelete('{{ $customer->name }}','{{ route('customer.destroy', ['id' => $customer->id]) }}')"
                                                        class="menu-link px-3"
                                                        data-kt-users-table-filter="delete_row">Delete</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--begin::Page Custom Javascript(used by this page)-->
    {{-- <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}
    <script>
        function handleDelete(name, url) {
            Swal.fire({
                title: "Peringatan!",
                html: `Yakin ingin hapus <strong>${name}</strong> ?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                cancelButtonText: 'Tidak jadi',
                confirmButtonText: "Gass!",
                customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: "btn btn-success",
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = url;
                } else if (result.dismiss == Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Tidak jadi!",
                        text: 'Data kamu tidak jadi dihapus!',
                        icon: 'error',
                        buttonsStyling: true,
                        confirmButtonText: 'Aman aja',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    })
                }
            })
        }
    </script>
    <script>
        const keySuccess = @json(session('success'));
        const keyError = @json(session('error'));
        if (keySuccess) {
            Swal.fire({
                title: "Sukses",
                html: keySuccess,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Siap Komandan!",
                customClass: {
                    confirmButton: "btn btn-success"
                }
            });
        }
        if (keyError) {
            Swal.fire({
                title: "Gagal",
                text: keyError,
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Siap Komandan!",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        }

        $(document).ready(function() {
            const table = $("#user_table").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });

            // Event handler untuk inisialisasi kembali tombol aksi setelah setiap paginasi
            table.on('draw.dt', function() {
                // Inisialisasi kembali tombol aksi di sini
                // Misalnya, Anda dapat memanggil fungsi inisialisasi tombol aksi di sini
                initAksiButtons();
            });

            // Fungsi untuk menginisialisasi tombol aksi
            function initAksiButtons() {
                // Tempatkan logika inisialisasi tombol aksi di sini
                console.log('Inisialisasi ulang tombol aksi');
            }
        });
    </script>
@endpush
