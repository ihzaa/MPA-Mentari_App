@extends('BackEnd.templates.all')

@section('cssAfter')
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item "><a href="{{route('admin_kategori_get')}}">Kategori</a></li>
<li class="breadcrumb-item active">Item</li>
@endsection

@section('page_title','List Item')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">List Item</h3>
                    <a href="{{route('admin_list.add.get',['id'=>$data['category_id']])}}"
                        class="btn btn-success btn-sm ml-auto">
                        <small><i class="fas fa-plus"></i></small> Tambah Item</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="list" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['items'] as $d)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td align="center">
                                    @if ($d->path)
                                    <img src="{{asset('storage/'.$d->path)}}" alt="" loading="lazy"
                                        style="max-height: 80px;">
                                    @else
                                    <span class="text-danger">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="jumlah">{{ $d->name }}</td>
                                <td>Rp. {{number_format($d->price,0,",",".")}}</td>
                                <td>{{$d->stock}}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{route('admin_list.edit.get',['id'=>$data['category_id'],'id_item'=>$d->id])}}"
                                        class="btn btn-primary btn-sm btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $d->id }}"
                                        data-name="{{ $d->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
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
@endsection

@section('jsAfter')
<script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    const URL = {
     delete : "{{route('admin_item.delete',['id'=>'wadadidaw'])}}"
 }
</script>
<script src="{{ asset('backend') }}/dist/js/pages/items.index.js"></script>

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
