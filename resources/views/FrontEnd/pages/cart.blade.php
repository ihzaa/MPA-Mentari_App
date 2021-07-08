@extends('FrontEnd.templates.all')

@section('content')
    <div class="container my-4 px-4">
        @if (count($data['items']) == 0)
            <div class="text-center my-5">
                <h4 class="mb-5">Ups! Anda belum memiliki item di keranjang.</h4>
                <b-cart-x style="width: 80px; height: 80px"></b-cart-x>
                <h4 class="mt-5">
                    Silahkan kembali ke halaman
                    <a href="{{ route('home') }}">home</a>
                    dan lanjut berbelanja.
                </h4>
            </div>
        @endif
        <form action="{{ route('user.keranjang.checkOut') }}" method="POST">
            <div class="row">
                @csrf
                <div class="col-md-8">
                    <h1>Keranjang</h1>
                    @foreach ($data['items'] as $item)
                        <hr />
                        <div class="row">
                            <div class="col-1 d-flex">
                                <div class="form-check my-auto mx-auto">
                                    <input class="form-check-input position-static" style="height: 17px; width: 17px"
                                        type="checkbox" value="{{ $item->cart_id }}" name="item[]" />
                                </div>
                            </div>
                            <div class="col-2">
                                @if ($item->img == null)
                                    <img src="{{ asset('frontend/images/no-image-available.png') }}" alt=""
                                        class="img-fluid" />
                                @else
                                    <img {{ asset($item->img) }} alt="" class="img-fluid" />
                                @endif
                            </div>
                            <div class="col-9">
                                <div>
                                    <p class="d-flex h5">
                                        {{ $item->name }}
                                        <span class="ml-auto"><button class="btn btn-sm btn-danger">
                                                <span class="icon">
                                                    <i class="fas fa-trash"></i>
                                                </span></button></span>
                                    </p>
                                    @if ($item->promo == null)
                                        <h3>
                                            <small>
                                                <strong>Rp. {{ number_format($item->price, 0, ',', '.') }}
                                                </strong>
                                            </small>
                                        </h3>
                                    @else
                                        <h3 class="d-flex justify-content-between">
                                            <small>
                                                <strong>Rp. {{ number_format($item->promo, 0, ',', '.') }}
                                                </strong>
                                            </small>
                                            <b-badge variant="success" class="align-self-center" style="font-size:16px">
                                                Promo
                                            </b-badge>
                                        </h3>
                                    @endif
                                    <h5>
                                        <small>persediaan {{ $item->stock }}</small>
                                    </h5>
                                </div>
                                <div class="d-flex">
                                    <ul class="ml-auto list-inline">
                                        <li class="list-inline-item">
                                            <form>
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    -
                                                </button>
                                            </form>
                                        </li>
                                        <li class="list-inline-item">
                                            <form>
                                                <input type="number" style="max-width: 50px"
                                                    value="{{ $item->quantity }}" />
                                            </form>
                                        </li>
                                        <li class="list-inline-item">
                                            <form>
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    +
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>Ringkasan Belanja</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                Total Harga:
                                <strong>Rp. <span id="total_harga">0</span></strong>
                            </h5>
                            <hr />
                            <h5 class="card-title">Pilih Alamat:</h5>
                            @if (count($data['addresses']) == 0)
                                <div>
                                    <h5>
                                        Anda belum memiliki alamat, tambahkan di halaman
                                        {{-- <router-link :to="{ name: 'profile' }">profil</router-link>. --}}
                                    </h5>
                                </div>
                            @else
                                <div>
                                    @foreach ($data['addresses'] as $address)
                                        <div class="d-flex card mb-2 p-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="address"
                                                    id="exampleRadios{{ $address->id }}" value="{{ $address->id }}">
                                                <label class="form-check-label" for="exampleRadios{{ $address->id }}">
                                                    {{ $address->address }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-block btn-primary mt-4">
                                        Beli
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
