@extends('BackEnd.templates.all')
@section('page_title', 'Ubah Password')
@section('cssAfter')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Ubah Password</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="formSatuSatunya" action="{{ route('admin_edit_password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="old">Password Lama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('old') is-invalid @enderror" id="old"
                                    name="old" placeholder="Password lama">
                            </div>
                            @error('old')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="new">Password Baru<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('new') is-invalid @enderror" id="new"
                                    name="new" placeholder="Password Baru">
                            </div>
                            @error('new')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="confirm">Konfirmasi Password Baru<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('confirm') is-invalid @enderror" id="confirm"
                                    name="confirm" placeholder="Konfirmasi Password Baru">
                            </div>
                            @error('confirm')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="text-danger">*Password minimal terdiri dari 6 huruf/angka</span>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsAfter')
    <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    @if (Session::get('icon'))
        <script>
            Swal.fire({
                icon: "{{ Session::get('icon') }}",
                title: "{{ Session::get('title') }}",
                text: "{{ Session::get('message') }}",
            });

        </script>
    @endif
@endsection
