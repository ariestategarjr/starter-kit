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
        {{-- @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->barcode }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->unit->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->purchase_price }}</td>
                <td>{{ $product->selling_price }}</td>
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
                <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('DD MMM Y') }}</td> 
        <td>
            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-end">Actions
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                <span class="svg-icon svg-icon-5 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
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
                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="menu-link px-3">Edit</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    @csrf
                    <a href="javascript:;"
                        onclick="handleDelete('{{ $product->name }}','{{ route('product.destroy', ['id' => $product->id]) }}')"
                        class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </td>
        </tr>
        @endforeach --}}
    </tbody>
</table>
