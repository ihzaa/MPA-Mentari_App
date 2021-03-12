@extends('BackEnd.templates.all')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>

@endsection

@section('page_title', 'Dashboard Admin')

@section('cssAfter')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger @if ($data['newTransaction']> 0) ld
                    ld-heartbeat @endif" id="box_new_transaction">
                    <div class="inner">
                        <h3 class="d-flex"><span id="newTransactionCount">{{ $data['newTransaction'] }}</span>
                            <ion-icon id="refresh_new_transaction" name="refresh-outline" size="small" class="ml-auto"
                                style="cursor: pointer"></ion-icon>
                        </h3>
                        <p>Pesanan Baru</p>

                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="overlay dark" id="loading_new_transaction" style="display: none;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <a href="{{ route('admin_transaksi_get') }}" class="small-box-footer">Lihat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $data['todayTransaction'] }}</h3>

                        <p>Pesanan Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <a href="{{ route('admin_transaksi_get') }}" class="small-box-footer">Lihat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $data['total_item'] }}</h3>

                        <p>Total Item</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                    <a href="{{ route('admin_kategori_get') }}" class="small-box-footer">Lihat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $data['total_user'] }}</h3>
                        <p>Total Pengguna</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="small-box-footer">-</div>
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <h4>Barang Promo</h4>
                <table id="promo" style="font-size: 14px" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:2%">No</th>
                            <th style="width:30%">Nama</th>
                            <th style="width:23%">Harga</th>
                            <th style="width:24%">Promo</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px">
                        @foreach ($data['promo_item'] as $d)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>Rp. {{ number_format($d->price, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($d->promo, 0, ',', '.') }}</td>
                                <td class="aksi" style="display: inline">
                                    <a href="{{ route('admin_list.edit.get', ['id' => $d->category_id, 'id_item' => $d->id]) }}"
                                        class="p-1 btn btn-primary btn-sm btn-edit">
                                        <i class="fas fa-edit fa-xs"></i>
                                    </a>
                                    <button type="button" class="p-1 btn ml-1 btn-danger btn-sm btn-hapus"
                                        data-id="{{ $d->id }}" data-name="{{ $d->name }}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Promo</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-5 mt-3">
                <h4>Cari Produk</h4>
                <div class="form-group">
                    {{-- <label>Minimal (.select2-danger)</label> --}}
                    <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option></option>
                        @foreach ($data['item'] as $i)
                            <option data-id="{{ $i->id }}" data-category="{{ $i->category_id }}">
                                {{ $i->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mx-auto my-5 text-center">
                    <p><strong>Bagikan produk promo hari ini melalui Whatsapp.</strong></p>
                    @if ($data['promo_count'] != 0)
                        <a href="{{ route('admin_whatsapp') }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-share">
                                Bagikan
                            </i>
                        </a>
                    @else
                        <a class="btn disabled btn-success">
                            <i class="fa fa-share">
                                Bagikan
                            </i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('jsAfter')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        const CONST_URL = {
            refresh: "{{ route('admin_getUnprocessedTransaction') }}",
            hapus: "{{ route('admin_promo_hapus', ['id' => 'sementara']) }}",
            item: "{{ route('admin_list.edit.get', ['id' => 'sementara', 'id_item' => 'id_sementara']) }}"
        }
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('#promo').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(document).on("click", "#refresh_new_transaction", function() {
            $('#loading_new_transaction').show();
            fetch(CONST_URL.refresh, {
                    headers: {
                        'Cache-Control': 'no-cache'
                    }
                }).then((result) => result.json())
                .then((data) => {
                    $("#newTransactionCount").html(data)
                    if (data != 0) {
                        $("#box_new_transaction").addClass('ld ld-heartbeat');
                    } else {
                        $("#box_new_transaction").removeClass('ld ld-heartbeat');
                    }
                }).then(() => {
                    $('#loading_new_transaction').hide();
                }).catch((err) => {
                    console.log(err);
                });
        })

        $(document).on('change', '.select2', function() {
            let temp = CONST_URL.item
            temp = temp.replace('sementara', $(this).find(':selected').data('category'))
            temp = temp.replace('id_sementara', $(this).find(':selected').data('id'))
            window.location.replace(temp)
        });

        $(document).on('click', '.btn-hapus',
            function() {
                Swal.fire({
                    title: 'Yakin mau menghapus promo produk ' + $(this).data('name') + '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let temp = CONST_URL.hapus
                        window.location.replace(temp.replace('sementara', $(this).data('id')))
                    }
                })
            }
        )

    </script>
@endsection
