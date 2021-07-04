@extends('FrontEnd.templates.all')

@section('page_title', 'Home')

@section('cssAfter')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /*carousel*/
        .carousel-image {
            height: 150px;
        }

        .title {
            font-size: 24px !important;
        }

        /* Produk */
        .btn-primary {
            border: var(--primarycolor);
            background-color: var(--primarycolor);
        }

        .btn-primary:hover {
            background-color: rgb(41, 119, 209);
        }

        .product-card {
            max-width: 20rem;
        }

        .product-card:hover {
            cursor: pointer;
            box-shadow: 0 8px 16px 0 var(--primarycolor);
        }

        .header {
            background-color: white;
        }

        .info {
            height: 110px;
        }

        .harga {
            height: 50px;
            font-size: 18px;
            font-weight: 1000 !important;
        }

        .card-body {
            padding: 0;
        }

        .card-footer {
            background-color: white;
        }

        /* Ribbon */
        .ribbon {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: absolute;
        }

        .ribbon::before,
        .ribbon::after {
            position: absolute;
            z-index: -1;
            content: "";
            display: block;
            border: 5px solid green;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 15px 0;
            background-color: green;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            color: #fff;
            font: 700 18px/1 "Roboto", sans-serif;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            text-align: center;
        }

        /* top right*/
        .ribbon-top-right {
            top: -10px;
            right: -10px;
        }

        .ribbon-top-right::before,
        .ribbon-top-right::after {
            border-top-color: transparent;
            border-right-color: transparent;
        }

        .ribbon-top-right::before {
            top: 0;
            left: 0;
        }

        .ribbon-top-right::after {
            bottom: 0;
            right: 0;
        }

        .ribbon-top-right span {
            left: -25px;
            top: 30px;
            transform: rotate(45deg);
        }

        @media only screen and (max-width: 700px) {
            .product-card {
                max-width: 40rem;
            }
        }

    </style>

@endsection

@section('content')
    <div>
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            {{-- <ol class="carousel-indicators">
                @if ($data['carousel-count'] > 0)
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                @else
                    @foreach ($data['carousel'] as $c)
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active">
                        </li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1" class="active">
                        </li>
                    @endforeach
                @endif
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol> --}}

            <div class="carousel-inner">
                @if ($data['carousel-count'] == 0)
                    <div class="carousel-item active">
                        <img src="https://docplayer.info/docs-images/112/201776938/images/13-2.jpg" width="1024"
                            height="350" class="d-block w-100" img-blank alt="blank">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tidak Ada Banner</h5>
                        </div>
                    </div>
                @else
                    @foreach ($data['carousel'] as $c)

                        <div class="carousel-item @if ($loop->first) active @endif">

                            <img src="{{ asset('storage/' . $c->image) }}" width="1024" height="350" class="d-block w-100"
                                alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $c->title }}</h5>
                                <p>{{ $c->description }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="my-4">
            <h1 align="center" style="color: var(--primarycolor)">
                <strong>Produk Kami</strong>
            </h1>
            <hr />
        </div>

        {{-- <Product /> --}}
        <div class="mx-5 my-3">
            {{-- <div class="row" v-if="!cekValue">
                <div class="col-md-6" v-if="searchvalue != ''">
                    <h4>
                        <strong>Pencarian : {{ searchvalue }}</strong>
                    </h4>
                </div>
                <div class="col-md-6" v-else>
                    <h4>
                        <strong>Pencarian : -</strong>
                    </h4>
                </div>
                <div class="col-md-6" v-if="!cekCategory">
                    <h4>
                        <strong>Kategori : {{ categoryname }}</strong>
                    </h4>
                </div>
                <div class="col-md-6" v-else>
                    <h4>
                        <strong>Kategori : -</strong>
                    </h4>
                </div>
            </div> --}}
            {{-- <div v-if="!load"> --}}
            {{-- <div v-if="productList"> --}}
            @if ($data['product'] != null)
                <div class="produk row justify-content-around align-item-center">
                    @foreach ($data['product'] as $p)
                        <div class="card product-card my-2 p-3 mx-1" data-aos="zoom-in-up">
                            @if ($p->promo != null)
                                <div class="ribbon ribbon-top-right">
                                    <span>Promo</span>
                                </div>
                            @endif
                            @if ($p->path != null)
                                <img width="100%" class="card-img-top" height="200"
                                    src="{{ asset('storage/' . $p->path) }}"" top></img>
                        @else                                            <img class=" card-img-top" width=" 100%"
                                    height="200" src="/frontend/images/no-image-available.png"
                                    style="border: 1px solid lightgray">
                                </img>
                            @endif
                            <div class="header card-header text-center" tag="header">
                                <h5>
                                    <strong>{{ $p->name }}</strong>
                                </h5>
                                <p style="margin-bottom: -10px">
                                    {{ $p->category_name }}
                                </p>
                            </div>
                            <div class="card-body">
                                @if (strlen($p->description) < 140)
                                    <div class="card-text info">
                                        {{ $p->description }}
                                    </div>
                                @else
                                    <div class="card-text info">
                                        {{ substr($p->description, 0, 140) . '...' }}
                                    </div>
                                @endif
                                @if ($p->promo == null)
                                    <div class="harga card-text text-right" style="line-height:10px">
                                        <p>Rp. {{ number_format($p->price, 0, ',', '.') }}</p>
                                    </div>
                                @else
                                    <div class="harga card-text text-right">
                                        <p>Rp. {{ number_format($p->promo, 0, ',', '.') }}</p>
                                        <p style="font-size:14px; margin-top:-20px">
                                            <s class="text-danger">Rp. {{ number_format($p->price, 0, ',', '.') }}</s>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer card-footer d-flex justify-content-between" tag="footer">
                                @if ($p->stock != 0)
                                    <form method="post" action="{{ route('user.keranjang.addOneItem') }}">
                                        @csrf
                                        <button class="btn btn-primary" type="submit" name="item_id"
                                            value="{{ $p->item_id }}">
                                            <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                                            </i>
                                        </button>
                                    </form>
                                @else
                                    <div class="btn btn-secondary disabled">
                                        <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                                        </i>
                                    </div>
                                @endif
                                @if ($p->stock != 0)
                                    <div class="persediaan text-center" style="margin-top:10px">
                                        <p style="line-height:2px">
                                            Persediaan
                                        </p>
                                        <p style="line-height:2px">
                                            <strong>{{ $p->stock }}</strong>
                                        </p>
                                    </div>
                                @else
                                    <div class="persediaan text-center" style="margin-top:10px">
                                        <p style="line-height:2px">
                                            Persediaan
                                        </p>
                                        <p style="line-height:2px">
                                            <strong class="text-danger">Kosong</strong>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center my-4" v-show="moreExists">
                    <button class="btn btn-primary" id="loadMore">
                        Tampilkan Lebih Banyak
                    </button>
                    <button class="btn btn-primary align-text-center ajax-load" style="font-size: 16px;display:none"
                        disabled>
                        <span class="spinner-border spinner-border-sm align-text-center" role="status"
                            aria-hidden="true"></span> Loading...
                    </button>
                </div>
                {{-- </div> --}}
            @else
                <div class="text-center my-5" v-else>
                    <p style="font-size:24px!important;line-height:20px">
                        <strong>Produk tidak ditemukan</strong>
                    </p>
                </div>
            @endif
            {{-- </div> --}}
            {{-- <div class="text-center my-5" v-else>
                <b-spinner style="width: 3rem; height: 3rem;"></b-spinner>
            </div> --}}
        </div>
    </div>
@endsection

@section('jsAfter')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        let lastId = 15;
        $('#loadMore').click(
            function() {

                $.ajax({
                    url: "{{ url('/') }}",
                    data: {
                        lastId
                    },
                    type: "get",
                    beforeSend: function() {
                        $('#loadMore').hide();
                        $('.ajax-load').show();
                    },
                    success: function(response) { // success callback function
                        if (response.lastId != -1) {
                            $('.produk').append(response.data);
                            lastId = response.lastId;
                            $('#loadMore').show();
                        }
                        $('.ajax-load').hide();
                        // console.log(response.lastId);
                    },
                    error: function(jqXhr, textStatus, errorMessage) { // error callback
                        console.log('Error: ' + errorMessage);
                    }
                    // beforeSend: function() {
                    //     $('.ajax-load').show();
                    // }
                })
            }
        )

        function loadMore() {

            let lastId = 15;
            $.ajax({
                    url: "{{ url('/product/') }}",
                    datatype: "json",
                    data: {
                        lastId
                    },
                    type: "get",
                    beforeSend: function() {

                        $('.ajax-load').show();
                    }
                })
                .done(function(response) {
                    if (response.length == 0) {
                        $('.auto-load').hide();
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
            // .fail(function(jqXHR, ajaxOptions, thrownError) {
            //     console.log('Server error occured');
            // });
        }
    </script>
@endsection
