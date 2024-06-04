<div class="modal-dialog modal-lg">
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
            <table class="table table-hover table-rounded table-striped border gy-7 gs-7" id="user_table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Satuan</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>



@push('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--begin::Page Custom Javascript(used by this page)-->
    {{-- <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}

    <script>
        function displayProductsData() {
            $.ajax({
                url: "{{ route('sale.displayProductsData') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if(response.data) {
                        console.log(response.data);
                    //     let tbody = $('#user_table tbody');
                    //     tbody.empty();

                    //      // Loop melalui data produk dan membuat baris untuk setiap produk
                    //     $.each(response.data, function(index, product) {
                    //         var row = $('<tr>');
                    //         row.append($('<td>').text(index + 1)); // Nomor urutan
                    //         row.append($('<td>').text(product.barcode)); // Barcode
                    //         row.append($('<td>').text(product.name)); // Nama
                    //         row.append($('<td>').text(product.satuan)); // Satuan
                    //         row.append($('<td>').text(product.kategori)); // Kategori
                    //         row.append($('<td>').text(product.stok)); // Stok
                    //         row.append($('<td>').text(product.harga_beli)); // Harga Beli
                    //         row.append($('<td>').text(product.harga_jual)); // Harga Jual
                    
                    //     // Membuat tombol aksi (contoh: tombol detail atau edit)
                    //     var actionCell = $('<td>');
                    //     var detailButton = $('<button>').text('Detail').addClass('btn btn-primary btn-sm');
                    //     var editButton = $('<button>').text('Edit').addClass('btn btn-info btn-sm');
                    //     actionCell.append(detailButton);
                    //     actionCell.append(editButton);
                    //     row.append(actionCell);
                        
                    //     tbody.append(row); // Tambahkan baris ke tbody
                    // });

                    }
                },
                error: function(xhr, thrownError) {
                    alert(`${xhr.status} ${xhr.responseText} ${thrownError}`);
                }
            });
        }
        $(document).ready(function() {
            displayProductsData();

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

{{-- <div class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Isi modal di sini -->
            <div class="modal-header">
                <h5 class="modal-title">Judul Modal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Isi modal -->
                <p>Isi modal di sini...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="modal fade" tabindex="-1" id="showModalProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modal title</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}