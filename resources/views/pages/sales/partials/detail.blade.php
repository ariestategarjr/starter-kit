<table class="table table-hover table-rounded table-striped border gy-7 gs-7" id="user_table">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
            <th>No</th>
            <th>Barcode</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga Jual</th>
            <th>Sub Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->barcode }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->amount }}</td>
                <td>{{ $row->selling_price }}</td>
                <td>{{ $row->sub_total }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger btn-danger-hide"
                        onclick="
                        deleteItem('{{ $row->id }}', '{{ $row->name }}')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
