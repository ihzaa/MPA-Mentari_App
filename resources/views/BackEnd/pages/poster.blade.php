@extends('BackEnd.templates.all')
@section('cssAfter')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('page_title', 'Poster')
@section('breadcrumb')
    <li class="breadcrumb-item active">Poster</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title my-auto">List Poster</h3>
                        <button type="button" class="btn btn-success btn-sm ml-auto" id="tambahPoster"><small><i
                                    class="fas fa-plus">
                                </i></small>
                            Tambah
                            Poster</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="poster" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%">No</th>
                                    <th style="width:45%">Gambar</th>
                                    <th style="width:15%">Judul</th>
                                    <th style="width:25%">Deskripsi</th>
                                    <th style="width:10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['poster'] as $d)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/' . $d->image) }}" alt="" width="600"></td>
                                        <td>{{ $d->title }}</td>
                                        <td>{{ $d->description }}</td>
                                        <td class="d-flex justify-content-around"><button type="button"
                                                class="btn btn-primary btn-sm btn-edit" data-id="{{ $d->id }}"
                                                data-name="{{ $d->title }}" data-desc="{{ $d->description }}" data-path="{{ asset('storage/' .$d->image) }}"><i
                                                    class="fas fa-edit">
                                                </i></button><button type="button" class="btn btn-danger btn-sm btn-hapus"
                                                data-id="{{ $d->id }}" data-name="{{ $d->title }}"><i class="fas fa-trash">
                                                </i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
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

    <div class="modal fade" id="modal-poster">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="form_poster" enctype="multipart/form-data">
                        @csrf
                        {{-- @foreach ($errors->all() as $e)
                            <li>
                                {{ $e }}
                            </li>
                        @endforeach --}}
                        <div class="row">
                            <div class="col-md-4">
                                <img id="blah" class="img-fluid" {{--
                                    src="{{ request()->is('*/tambahPoster*') ? asset('backend/dist/img/picture.svg') : asset($data['poster'][0]->image) }}"
                                    --}} src="{{ asset('backend/dist/img/picture.svg') }}"
                                    alt="your image" />
                            </div>
                            <div class="col-md-8 d-flex">
                                <div class="form-group col-md-12 my-auto">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imgInp" name="image">
                                        <label class="custom-file-label"
                                            for="imgInp">{{ request()->is('*/tambahPoster*') ? 'Foto Poster' : 'Foto poster.jpg' }}</label>
                                        <small class="form-text text-muted">- Ukuran max 500KB</small>
                                        <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg,
                                            png , dll)</small>
                                        <small class="form-text text-muted">- Lebar foto minimal 560</small>
                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judulPoster">Judul</label>
                            <input type="text" class="form-control @error('judulPoster')is-invalid @enderror"
                                id="judulPoster" name="judulPoster" placeholder="Masukkan Judul Poster">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="deskripsiPoster">Deskripsi</label>
                            <textarea class="form-control" rows="3" id="deskripsiPoster" name="deskripsiPoster"
                                placeholder="Masukkan Deskripsi Poster"></textarea>
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
        <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script>
            const url = {
                tambah: "{{ route('admin_poster_add') }}",
                edit: "{{ route('admin_poster_edit', ['id' => 'sementara']) }}",
                hapus: "{{ route('admin_poster_hapus', ['id' => 'sementara']) }}",
            };
            $(function() {
                $('#poster').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": true,
                    "responsive": true,
                });
            });

            $('#tambahPoster').click(
                function() {
                    openModal({
                        title: 'Tambah Poster',
                        url: url.tambah
                    })
                }
            )

            $('.btn-edit').click(
                function() {
                    let temp = url.edit
                    openModal({
                        title: 'Edit Poster',
                        url: temp.replace('sementara', $(this).data('id')),
                        value: $(this).data('name')
                    })
                    $('#blah').attr('src', $(this).data('path'));
                    $('#judulPoster').attr('value', $(this).data('name'));
                    $('#deskripsiPoster').html($(this).data('desc'));
                }
            )

            $('.btn-hapus').click(
                function() {
                    Swal.fire({
                        title: 'Yakin mau menghapus poster ' + $(this).data('name') + '?',
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
            )

            function openModal(data) {
                $('#modal-poster').modal('show');
                $('#modal-title').html(data.title);
                $('#modal-poster form').attr('action', data.url);
                $('#namaPoster').val(data.value)
            }

            // custom input gambar
            // bsCustomFileInput.init();

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#imgInp").change(function() {
                readURL(this);
            });

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
                    title: 'Tambah Poster',
                    url: url.tambah
                })

            </script>
        @endif
    @endsection
