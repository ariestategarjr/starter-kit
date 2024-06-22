<div class="modal-dialog modal-lg" style="max-width: 90%;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Data Produk</h3>
            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>

        <div class="modal-body">
            {{-- <table class="table table-hover table-rounded table-striped border gy-7 gs-7" id="user_table"> --}}
            <table id="user_table" class="table table-bordered table-striped dataTable dtr-inline collapsed">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga Jual</th>
                        <th>Jumlah</th>
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
        function selectProduct(barcode, product_name) {
            $('#barcode').val(barcode);
            $('#product_name').val(product_name);
            $('#amount').val(parseInt($(`#amount${barcode}`).val()));

            $('#productModal').on('hidden.bs.modal', function(e) {
                $('#barcode').focus();
                // checkBarcodeInput();
            });

            $('#productModal').modal('hide');

            // Reset
            $(`#amount${barcode}`).val('1');
            // $(`#amount${barcode}`).focus();
        }

        function reloadDataTable() {
            console.log("Reload Purchase Table");
            $('#user_table').DataTable().ajax.reload();
        }

        $(document).ready(function() {
            var table = $("#user_table").DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "pageLength": 10, // Jumlah data default yang ditampilkan per halaman
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ], // Opsi jumlah data per halaman
                "ajax": {
                    "url": "{{ route('purchase.showProductsModalData') }}",
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
                        "data": "barcode"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "category_name"
                    },
                    {
                        "data": "stock"
                    },
                    {
                        "data": "selling_price"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return `<input type='number' id='amount${full.barcode}' value=1 style='display: inline-block; width: 70px; max-width: 100%; height: 30px;' autofocus>`;
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return `<button type='button' class='btn btn-sm btn-primary' onclick='selectProduct(
                                    "${full.barcode}",
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

            // // Reload DataTable setiap kali modal dibuka
            // $('#productModal').on('shown.bs.modal', function() {
            //     reloadDataTable();
            // });
        });
    </script>
@endpush

{{-- // function displayProductsData() {
// $.ajax({
// url: "{{ route('sale.displayProductsData') }}",
// type: "GET",
// dataType: "json",
// success: function(response) {
// if (response.data) {
// console.log(response.data);
// let tbody = $('#user_table tbody');
// tbody.empty();

// // Loop melalui data produk dan membuat baris untuk setiap produk
// // $.each(response.data, function(index, product) {
// // var row = $('<tr>');
    // // row.append($('<td>').text(index + 1)); // Nomor urutan
        // // row.append($('
    <td>').text(product.barcode)); // Barcode
        // // row.append($('
    <td>').text(product.name)); // Nama
        // // row.append($('
    <td>').text(product.satuan)); // Satuan
        // // row.append($('
    <td>').text(product.kategori)); // Kategori
        // // row.append($('
    <td>').text(product.stok)); // Stok
        // // row.append($('
    <td>').text(product.harga_beli)); // Harga Beli
        // // row.append($('
    <td>').text(product.harga_jual)); // Harga Jual

        // // // Membuat tombol aksi (contoh: tombol detail atau edit)
        // // var actionCell = $('
    <td>');
        // // var detailButton = $('<button>').text('Detail').addClass('btn btn-primary btn-sm');
            // // var editButton = $('<button>').text('Edit').addClass('btn btn-info btn-sm');
                // // actionCell.append(detailButton);
                // // actionCell.append(editButton);
                // // row.append(actionCell);

                // // tbody.append(row); // Tambahkan baris ke tbody
                // // });

                // }
                // },
                // error: function(xhr, thrownError) {
                // alert(`${xhr.status} ${xhr.responseText} ${thrownError}`);
                // }
                // });
                // } --}}

{{-- // <div class="modal fade" tabindex="-1" id="showModalProduct">
//     <div class="modal-dialog">
//         <div class="modal-content">
//             <div class="modal-header">
//                 <h3 class="modal-title">Modal title</h3>

//                 <!--begin::Close-->
//                 <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
//                     <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
//                 </div>
//                 <!--end::Close-->
//             </div>

//             <div class="modal-body">
//                 <p>Modal body text goes here.</p>
//             </div>

//             <div class="modal-footer">
//                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
//                 <button type="button" class="btn btn-primary">Save changes</button>
//             </div>
//         </div>
//     </div>
// </div> --}}
