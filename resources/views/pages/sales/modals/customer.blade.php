<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Data Pelanggan</h3>
            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>

        <div class="modal-body">
            {{-- <table class="table table-hover table-rounded table-striped border gy-7 gs-7" id="user_table"> --}}
            <table id="customer_table" class="table table-bordered table-striped dataTable dtr-inline collapsed">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{--  --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('assets/plugins/custom/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables-responsive/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@push('script')
    {{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/custom/datatables-jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!--begin::Page Custom Javascript(used by this page)-->
    {{-- <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}

    <script>
        function selectCustomer(id, name) {
            $('#customer').val(name);
            $('#customer_id').val(id);

            // $('#productModal').on('hidden.bs.modal', function(e) {
            //     $('#barcode').focus();
            // });

            $('#customerModal').modal('hide');
        }

        $(document).ready(function() {
            // $("#customer_table").DataTable();
            var table = $("#customer_table").DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "pageLength": 10, // Jumlah data default yang ditampilkan per halaman
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ], // Opsi jumlah data per halaman
                "ajax": {
                    "url": "{{ route('sale.showCustomersModalData') }}",
                    "type": "POST",
                    "data": function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.search = $('input[type="search"]')
                            .val(); // Ambil nilai dari input pencarian bawaan DataTable
                    },
                    "dataSrc": "data"
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "address"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return `<button type='button' class='btn btn-sm btn-primary' onclick='selectCustomer(
                            "${full.id}",
                            "${full.name}"
                            )'>Pilih</button>`;
                        }
                    }
                ]
            });

            // Event listener untuk input pencarian bawaan DataTable
            $('input[type="search"]').on('keyup change', function() {
                table.draw();
            });
        });
    </script>
@endpush
