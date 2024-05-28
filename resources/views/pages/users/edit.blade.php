@extends('layouts.app.main')
@section('title')
    IMM - Starter Kit
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Edit User {{ $user->name }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="name" class="form-label required">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="role" class="form-label required">role</label>
                                <select name="role_id" id="role" class="form-select text-uppercase">
                                    <option value="" disabled selected>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password Baru Jika Dibutuhkan">
                            </div>
                            <div class="col-12 mt-10">
                                <a href="javascript:;" onclick="goBack()" class="btn btn-secondary">Kembali</a>
                                <button class="btn btn-success" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
@endsection
@push('script')
    <script>
        const goBack = () => {
            return window.history.back();
        }
        const keyError = @json(session('error'));
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
    </script>
@endpush
