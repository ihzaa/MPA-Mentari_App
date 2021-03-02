@extends('BackEnd.templates.all')
@section('cssAfter')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('page_title', 'Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item active">Transaksi</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title my-auto">Daftar Transaksi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="transaksi" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%">No</th>
                                    <th style="width:30%">Tanggal</th>
                                    <th style="width:30%">Nama Pembeli</th>
                                    <th style="width:20%">Terkirim</th>
                                    <th style="width:15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['userTransaction'] as $d)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d M Y') }}</td>
                                        <td>{{ $d->name }}</td>
                                        @if ($d->status == 0)
                                            <td style="background-color: red; color:white">
                                                Belum
                                            </td>
                                        @else
                                            <td style="background-color: green; color:white">
                                                Sudah
                                            </td>
                                        @endif

                                        <td class="m-auto">
                                            <button type="button" class="btn btn-warning btn-detail"
                                                data-id="{{ $d->id }}">Detail
                                            </button>
                                            {{-- <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modal-detail">
                                                Detail
                                            </button> --}}
                                            {{-- <a href="{{ route('admin_list.item.category', ['id' => $d->id]) }}"
                                                class="btn btn-block btn-warning btn-sm">Detail</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pembeli</th>
                                    <th>Status</th>
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


    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title"><strong>MENTARI</strong></h3>
                    <h5 class="m-auto"><strong>Detail Pembelian</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p style="margin-bottom:-2px">Nama : <strong id="customerName"></strong></p>
                            <p style="margin-bottom:-2px">Alamat : <strong id="customerAddress"></strong></p>
                        </div>
                        <div>
                            <p style="margin-bottom:-2px">No.telp : <strong id="customerPhone"></strong></p>
                            <p>Tanggal : <strong id="customerDate"></strong></p>
                        </div>
                    </div>

                    {{-- <form action="" method="POST" id="form_detail" enctype="multipart/form-data">
                        @csrf

                    </form> --}}
                    <table id="tableDetail" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:3%">No</th>
                                <th style="width:52%">Nama Barang</th>
                                <th style="width:10%">Kuantitas</th>
                                <th style="width:45%">Harga (Rp)</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTableDetail">

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>Total</strong></td>
                                <th id="total"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer" id="modal-button">

                </div>
                <!-- /.modal-content -->
                <div></div>
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
        <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous"></script>
        <script>
            const url = {
                show: "{{ route('admin_transaksi_detail', ['id' => 'sementara']) }}",
                edit: "{{ route('admin_kirim', ['id' => 'sementara']) }}",
                batal: "{{ route('admin_batal_kirim', ['id' => 'sementara']) }}"
            };
            $(function() {
                $('#transaksi').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                });
                $('#tableDetail').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "sort": false,
                    "searching": false,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            $(document).on('click', '.btn-detail',
                function() {
                    let tmpUrl = url.show
                    let i = 1;
                    let total = 0;
                    tmpUrl = tmpUrl.replace('sementara', $(this).data("id"))
                    $('#main_loading').show();
                    fetch(tmpUrl).then(
                        (resp) => resp.json()
                    ).then((data) => {
                        document.getElementById("bodyTableDetail").innerHTML = '';
                        document.getElementById("customerName").innerHTML = data.data.transaksi[0].name;
                        document.getElementById("customerAddress").innerHTML = data.data.transaksi[0].address;
                        document.getElementById("customerPhone").innerHTML = data.data.transaksi[0].phone;
                        document.getElementById("customerDate").innerHTML = moment(data.data.transaksi[0]
                                .created_at)
                            .format('LL');
                        data.data.cart.forEach(element => {
                            document.getElementById("bodyTableDetail").innerHTML +=
                                '<tr> <td>' + i + '</td><td> ' + element.name +
                                '</td> <td> ' + element.quantity + '</td> <td>' + formatPrice(element
                                    .price * element.quantity) + '</td> </tr>';
                            i++;
                        });
                        document.getElementById('total').innerHTML = formatPrice(total);
                        if (data.data.transaksi[0].status == 0) {
                            document.getElementById('modal-button').innerHTML =
                                '<button type="button" data-id="' +
                                data
                                .data.transaksi[0].id +
                                '"class = "btn btn-kirim btn-primary ml-auto"> Terkirim </button>';
                        } else {
                            document.getElementById('modal-button').innerHTML =
                                '<button type="button" data-id="' +
                                data
                                .data.transaksi[0].id +
                                '"class = "btn btn-batal btn-primary ml-auto"> Batal Kirim </button>';
                        }
                        $('#main_loading').hide();
                    })
                    openModal({

                    })
                }
            )

            $(document).on('click', '.btn-kirim',
                function() {
                    Swal.fire({
                        title: 'Ingin mengubah status transaksi ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: `Ya`,
                        cancelButtonText: `Tidak`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            let temp = url.edit
                            window.location.replace(temp.replace('sementara', $(this).data('id')))
                        }
                    })
                }
            )

            $(document).on('click', '.btn-batal',
                function() {
                    Swal.fire({
                        title: 'Ingin mengubah status transaksi ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: `Ya`,
                        cancelButtonText: `Tidak`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            let temp = url.batal
                            window.location.replace(temp.replace('sementara', $(this).data('id')))
                        }
                    })
                }
            )

            function openModal(data) {
                $('#modal-detail').modal('show');
            }

            function formatPrice(value) {
                let val = (value / 1).toFixed(0).replace(".", ",");
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function readURL(input) {
                // let label =
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                    $('#labelFoto').html($("#imgInp")[0].files[0].name);
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
                    url: url.show
                })

            </script>
        @endif
    @endsection
