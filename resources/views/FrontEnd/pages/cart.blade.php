@extends('FrontEnd.templates.all')

@section('page_title', 'Keranjang')

@section('content')
    <div class="container my-4 px-4">
        @if (count($data['items']) == 0)
            <div class="text-center my-5">
                <h4 class="mb-5">Ups! Anda belum memiliki item di keranjang.</h4>
                <b-cart-x style="width: 80px; height: 80px"></b-cart-x>
                <h4 class="mt-5">
                    Silahkan kembali ke halaman
                    <a href="{{ route('user.home') }}">home</a>
                    dan lanjut berbelanja.
                </h4>
            </div>
        @else
            <form action="{{ route('user.keranjang.checkOut') }}" method="POST" onsubmit="return confirm('Yakin membeli item?');">
                <div class="row">
                    @csrf
                    <div class="col-md-8">
                        <form action=""></form>
                        <h1>Keranjang</h1>
                        @foreach ($data['items'] as $item)
                            <hr />
                            <div class="row">
                                <div class="col-1 d-flex">
                                    <div class="form-check my-auto mx-auto">
                                        <input class="form-check-input position-static item_check"
                                            style="height: 17px; width: 17px" type="checkbox" value="{{ $item->cart_id }}"
                                            name="item[]"
                                            data-price="{{ $item->promo == null ? $item->price : $item->promo }}"
                                            data-quantity="{{ $item->quantity }}" />
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
                                            <span class="ml-auto">
                                                <button class="btn btn-sm btn-danger btn-delete"
                                                    data-id="{{ $item->cart_id }}" type="button">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
                                            </span>
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
                                                <form method="POST"
                                                    action="{{ route('user.keranjang.decrease.item.quantity') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->cart_id }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                                        -
                                                    </button>
                                                </form>
                                            </li>
                                            <li class="list-inline-item">
                                                <form method="POST"
                                                    action="{{ route('user.keranjang.change.item.quantity') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->cart_id }}">
                                                    <input type="number" style="max-width: 50px"
                                                        value="{{ $item->quantity }}" name="quantity" />
                                                </form>
                                            </li>
                                            <li class="list-inline-item">
                                                <form method="POST"
                                                    action="{{ route('user.keranjang.increase.item.quantity') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->cart_id }}">
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
                                                        id="exampleRadios{{ $address->id }}" required
                                                        value="{{ $address->id }}">
                                                    <label class="form-check-label"
                                                        for="exampleRadios{{ $address->id }}">
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
        @endif
    </div>
@endsection

@section('jsAfter')
    <script>
        const URL = {
            delete: "{{ route('user.keranjang.delete.item') }}"
        }

        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id')
            if (confirm('Yakin menghapus item?')) {
                fetch(URL.delete, {
                        method: 'POST', // *GET, POST, PUT, DELETE, etc.
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                    .finally(() => {
                        location.reload()
                    })
            }
        })

        let elementTotalHarga = $("#total_harga")

        $(document).on('change', '.item_check', function() {
            let elementCheckboxItem = $(".item_check:checked");
            let totalHarga = 0;
            for (let i = 0; i < elementCheckboxItem.length; i++) {
                totalHarga += $(elementCheckboxItem[i]).data('price')*$(elementCheckboxItem[i]).data('quantity')
            }
            $(elementTotalHarga).html(totalHarga)
        })
    </script>
@endsection
