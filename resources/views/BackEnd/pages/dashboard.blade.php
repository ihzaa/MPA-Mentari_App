@extends('BackEnd.templates.all')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>

@endsection

@section('page_title','Dashboard Admin')

@section('cssAfter')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">
{{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger @if ($data['newTransaction'] > 0)
                ld ld-heartbeat
            @endif" id="box_new_transaction">
                <div class="inner">
                    <h3 class="d-flex"><span id="newTransactionCount">{{$data['newTransaction']}}</span>
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
                <a href="{{ route('admin_transaksi_get')}}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$data['todayTransaction']}}</h3>

                    <p>Pesanan Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cart-plus"></i>
                </div>
                <a href="{{ route('admin_transaksi_get')}}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$data['total_item']}}</h3>

                    <p>Total Item</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th"></i>
                </div>
                <a href="{{route('admin_kategori_get')}}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$data['total_user']}}</h3>

                    <p>Total Pengguna</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="small-box-footer">-</div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('jsAfter')
<script>
    const CONST_URL = {
        refresh : "{{route('admin_getUnprocessedTransaction')}}"
    }

    $(document).on("click","#refresh_new_transaction",function(){
        $('#loading_new_transaction').show();
        fetch(CONST_URL.refresh,{
  headers: {
    'Cache-Control': 'no-cache'
  }
}).then((result) => result.json())
        .then((data)=>{
            $("#newTransactionCount").html(data)
            if(data != 0){
                $("#box_new_transaction").addClass('ld ld-heartbeat');
            }else{
                $("#box_new_transaction").removeClass('ld ld-heartbeat');
            }
        }).then(()=>{
            $('#loading_new_transaction').hide();
        }).catch((err) => {
            console.log(err);
        });
    })
</script>
@endsection
