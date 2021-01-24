@extends('BackEnd.templates.all')

@section('breadcrumb')

@endsection

@section('page_title','List Item')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">List Item</h3>
                    <button type="button" class="btn btn-success btn-sm ml-auto" id="tambahKategori"><small><i
                                class="fas fa-plus">
                            </i></small>
                        Tambah
                        Item</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="lists" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th style="width:30%">Gambar</th>
                                <th style="width:25%">Nama</th>
                                <th style="width:15%">Harga</th>
                                <th style="width:15%">Stok</th>
                                <th style="width:10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['items'] as $d)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>
                                    @if ($d->path)
                                    <img src="{{asset($d)}}" alt="" loading="lazy">
                                    @else
                                    <span class="text-danger">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="jumlah">{{ $d->name }}</td>
                                <td>Rp. {{number_format($d->price,0,",",".")}}</td>
                                <td>{{$d->stock}}</td>
                                <td class="d-flex justify-content-around"><button type="button"
                                        class="btn btn-primary btn-sm btn-edit" data-id="{{ $d->id }}"
                                        data-name="{{ $d->name }}"><i class="fas fa-edit">
                                        </i></button><button type="button" class="btn btn-danger btn-sm btn-hapus"
                                        data-id="{{ $d->id }}" data-name="{{ $d->name }}"><i class="fas fa-trash">
                                        </i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width:5%">No</th>
                                <th style="width:30%">Gambar</th>
                                <th style="width:25%">Nama</th>
                                <th style="width:15%">Harga</th>
                                <th style="width:15%">Stok</th>
                                <th style="width:10%">Aksi</th>
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
@endsection

@section('jsAfter')
<script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    const URL = {
     delete : "{{route('admin_item.delete',['id'=>'wadadidaw'])}}"
 }
</script>
<script src="{{ asset('backend')}}/dist/js/pages/items.index.js"></script>

@if(Session::get('icon'))
<script>
    Swal.fire({
            icon: "{{Session::get('icon')}}",
            title: "{{Session::get('title')}}",
            text: "{{Session::get('text')}}",
        });
</script>
@endif
@endsection
