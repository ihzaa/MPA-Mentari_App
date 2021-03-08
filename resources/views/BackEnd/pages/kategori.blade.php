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
                        <button type="button" class="btn btn-success btn-sm ml-auto" id="tambahKategori"><small><i
                                    class="fas fa-plus">
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
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>{{ $d->name }}
                                        </td>
                                        <td class="jumlah">{{ $d->items_count }}</td>
                                        <td> <a href="{{ route('admin_list.item.category', ['id' => $d->id]) }}"
                                                class="btn btn-block btn-warning btn-sm">Lihat</a>
                                        </td>
                                        <td style="display: inline"><button type="button"
                                                class="btn btn-primary btn-sm btn-edit" data-id="{{ $d->id }}"
                                                data-name="{{ $d->name }}"><i class="fas fa-edit fa-xs">
                                                </i></button><button type="button"
                                                class="ml-1 btn btn-danger btn-sm btn-hapus" data-id="{{ $d->id }}"
                                                data-name="{{ $d->name }}"><i class="fas fa-trash fa-xs">
                                                </i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Produk</th>
                                    <th>List Produk</th>
                                    <th>Aksi</th>
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

    <div class="modal fade" id="modal-kategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="form_kategori">
                        @csrf
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" class="form-control @error('namaKategori')is-invalid @enderror"
                                id="namaKategori" name="namaKategori" placeholder="Masukkan Nama Kategori">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                        </div>
                    </form>
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
        <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script>
            const url = {
                tambah: "{{ route('admin_kategori_add') }}",
                edit: "{{ route('admin_kategori_edit', ['id' => 'sementara']) }}",
                hapus: "{{ route('admin_kategori_hapus', ['id' => 'sementara']) }}",
            };
            $(function() {
                $('#kategori').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            $('#tambahKategori').click(
                function() {
                    openModal({
                        title: 'Tambah Kategori',
                        url: url.tambah
                    })
                }
            )

            $(document).on('click', '.btn-edit',
                function() {
                    let temp = url.edit
                    openModal({
                        title: 'Edit Kategori',
                        url: temp.replace('sementara', $(this).data('id')),
                        value: $(this).data('name')
                    })
                }
            )

            $(document).on('click', '.btn-hapus',
                function() {
                    let parent = $(this).parent().parent().find(".jumlah").html();
                    if (parent != 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Kategori masih memiliki produk!'
                        })
                    } else {
                        Swal.fire({
                            title: 'Yakin mau menghapus kategori ' + $(this).data('name') + '?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: `Ya`,
                            cancelButtonText: `Tidak`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                let temp = url.hapus
                                window.location.replace(temp.replace('sementara', $(this).data('id')))
                            }
                        })
                    }
                }
            )

            function openModal(data) {
                $('#modal-kategori').modal('show');
                $('#modal-title').html(data.title);
                $('#modal-kategori form').attr('action', data.url);
                $('#namaKategori').val(data.value)
            }

        </script>
        @if (Session::get('icon'))
            <script>
                Swal.fire({
                    icon: "{{ Session::get('icon') }}",
                    title: "{{ Session::get('title') }}",
                    text: "{{ Session::get('text') }}",
                });

            </script>
        @endif
        @if ($errors->any())
            <script>
                openModal({
                    title: 'Tambah Kategori',
                    url: url.tambah
                })

            </script>
        @endif
    @endsection
