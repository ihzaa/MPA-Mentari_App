@extends('FrontEnd.templates.all')

@section('page_title', 'Detail')

@section('cssAfter')
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}">
    <style>
        body {
            min-height: 75rem;
            padding-top: 80px;
        }

        .slider {
            min-width: 310px;
        }

        .img-wrapper .js-fullheight {
            width: 100%;
            max-height: 400px;
            /* background-image: linear-gradient(gray 100%, transparent 0); */
        }

        .btn {
            border: var(--primarycolor);
            background-color: var(--primarycolor);
        }

        .btn:hover {
            background-color: rgb(41, 119, 209);
        }

        @media only screen and (max-width: 700px) {
            .detail-header {
                flex-direction: column;
            }

            .detail-header h1 {
                font-size: 22px;
            }

            .detail-header p,
            .detail-body h5 {
                font-size: 14px;
            }

            .detail-body h4 {
                font-size: 18px;
            }

            .cart {
                flex-direction: column;
            }

            .product-description {
                padding: 30px 0 20px 0 !important;
            }
        }

    </style>

@endsection

@section('content')
    <div>
        <div class="mx-4 my-3">
            <div class="card p-3">
                <div class="row justify-content-around">
                    <div class="slider col-5">
                        <div>
                            <div class="img-wrapper">
                                {{-- <Slider /> --}}
                                @if (count($data['image']) != 0)
                                    <div class="home-slider owl-carousel js-fullheight">
                                        @foreach ($data['image'] as $i)
                                            <div class="slider-item js-fullheight"
                                                style="background-image:url({{ asset('storage/' . $i->path) }});">
                                                <div class="overlay"></div>
                                                <div class="container">
                                                    <div
                                                        class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                                                        <div class="col-md-12 ftco-animate">
                                                            {{-- <div class="text w-100 text-center">
                                                            <h2>Best Place to Travel</h2>
                                                            <h1 class="mb-3">Norway</h1>
                                                        </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- <div class="slider-item js-fullheight"
                                            style="background-image:url(images/slider-2.jpg);">
                                            <div class="overlay"></div>
                                            <div class="container">
                                                <div
                                                    class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                                                    <div class="col-md-12 ftco-animate">
                                                        <div class="text w-100 text-center">
                                                            <h2>Best Place to Travel</h2>
                                                            <h1 class="mb-3">Japan</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="slider-item js-fullheight"
                                            style="background-image:url(images/slider-2.jpg);">
                                            <div class="overlay"></div>
                                            <div class="container">
                                                <div
                                                    class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                                                    <div class="col-md-12 ftco-animate">
                                                        <div class="text w-100 text-center">
                                                            <h2>Best Place to Travel</h2>
                                                            <h1 class="mb-3">Singapore</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                @else
                                    {{-- slider end --}}
                                    {{-- <carousel :perPage="1" v-if="imageCount != 0">
                                    <slide v-for="slide in detailImage" v-bind:key="slide.id">
                                        <img :src="global + slide.path" />
                                    </slide>
                                </carousel> --}}
                                    {{-- <carousel :perPage="1" v-else align="center">
                                    <slide>
                                        <img width="100%" height="280" src="/frontend/images/no-image-available.png" />
                                    </slide>
                                </carousel> --}}
                                    <img width="100%" height="280" src="/frontend/images/no-image-available.png" />
                                @endif
                            </div>
                        </div>
                        {{-- --- --}}
                    </div>
                    <div class="product-description p-3 col-7">
                        <div class="detail-header d-flex justify-content-between">
                            <h1 class="align-self-center">
                                <strong>{{ $data['detail'][0]->name }}</strong>
                            </h1>

                            <span class="badge align-self-center badge-success" style="font-size:16px">
                                Promo
                            </span>
                            <p class="align-self-center">
                                {{ $data['detail'][0]->category_name }}
                            </p>
                        </div>
                        <hr class="my-1" />
                        <div class="detail-body my-3">
                            <h5>{{ $data['detail'][0]->description }}</h5>
                            @if ($data['detail'][0]->promo == null)
                                <h3 class="mt-4 text-right" v-if="detailInfo.promo == null">
                                    <strong>
                                        Rp. {{ number_format($data['detail'][0]->price, 0, ',', '.') }}
                                    </strong>
                                </h3>
                            @else
                                <div class="mt-4 text-right">
                                    <h3>
                                        <strong>Rp.
                                            {{ number_format($data['detail'][0]->promo, 0, ',', '.') }}</strong>
                                    </h3>
                                    <p style="font-size:18px; margin-top:-10px">
                                        <strong>
                                            <s class="text-danger">Rp.
                                                {{ number_format($data['detail'][0]->price, 0, ',', '.') }}
                                            </s>
                                        </strong>
                                    </p>
                                </div>
                            @endif
                            <div class="cart d-flex justify-content-between my-5">
                                @if ($data['detail'][0]->stock != 0)
                                    <h5 class="align-self-center" v-if="detailInfo.stock != 0">
                                        Persediaan barang :
                                        <strong>{{ $data['detail'][0]->stock }}</strong>
                                    </h5>
                                @else
                                    <h5 class="align-self-center" v-else>
                                        Persediaan barang :
                                        <strong class="text-danger">Kosong</strong>
                                    </h5>
                                @endif
                                @if ($data['detail'][0]->stock != 0)
                                    <form method="post" action="{{ route('user.keranjang.addOneItem') }}">
                                        @csrf
                                        <button class="btn btn-primary align-self-center" type="submit" name="item_id"
                                            value="{{ $data['detail'][0]->id }}">
                                            Tambah Keranjang
                                            <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                                            </i>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn align-self-center btn-secondary" disabled>
                                        Tambah Keranjang
                                        <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                                        </i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsAfter')
    {{-- <script src="js/jquery.min.js"></script> --}}
    <script src="{{ URL::asset('frontend/js/popper.js') }}"></script>
    {{-- <script src="js/bootstrap.min.js"></script> --}}
    <script src="{{ URL::asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/js/main.js') }}"></script>
@endsection
