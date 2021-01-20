@extends('BackEnd.templates.all')
@section('cssAfter')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('page_title', 'Kategori Produk')
@section('breadcrumb')
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title my-auto">List Kategori Produk</h3>
                        <button type="button" class="btn btn-success btn-sm ml-auto" data-toggle="modal"
                            data-target="#modal-default"><small><i class="fas fa-plus">
                                </i></small>
                            Tambah
                            Kategori</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="kategori" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%">No</th>
                                    <th style="width:55%">Nama Kategori</th>
                                    <th style="width:15%">Jumlah Produk</th>
                                    <th style="width:15%">List Produk</th>
                                    <th style="width:10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['kategori'] as $d)
                                    <tr>
                                        <td align="center">1</td>
                                        <td>{{ $d->name }}
                                        </td>
                                        <td>Win 95+</td>
                                        <td> <button type="button" class="btn btn-block btn-warning btn-sm">Lihat</button>
                                        </td>
                                        <td class="d-flex justify-content-around"><button type="button"
                                                class="btn btn-primary btn-sm"><i class="fas fa-edit">
                                                </i></button><button type="button" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash">
                                                </i></button></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>2</td>
                                    <td>Internet
                                        Explorer 5.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td>5</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Internet
                                        Explorer 5.5
                                    </td>
                                    <td>Win 95+</td>
                                    <td>5.5</td>
                                    <td>5.5</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Internet
                                        Explorer 6
                                    </td>
                                    <td>Win 98+</td>
                                    <td>6</td>
                                    <td>6</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Produk</th>
                                    <th>List Produk</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form
                        action="{{ request()->is('*/blog/tambah*') ? route('admin_tambah_blog') : route('admin_edit_blog', ['id' => $data['blog']->id]) }}"
                        method="POST" id="form_kategori"> --}}
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="namaKategori" placeholder="Masukkan Nama">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary ml-auto">Simpan</button>
                        </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endsection

    @section('jsAfter')
        <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script>
            $(function() {
                $('#kategori').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": true,
                    "responsive": true,
                });
            });

        </script>
    @endsection
