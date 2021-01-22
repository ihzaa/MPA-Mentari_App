@section('page_title','All product')
<div>
    <div class="row">
        <div class="col-md-12 d-flex">
            <select wire:model="paginate">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    @foreach ($data['items'] as $item)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    ini gambar
                </div>
                <div class="col-md-8">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text">Harga: {{$item->price}}</p>
                </div>
                <div class="col-md-2 text-right">
                    <button class="btn btn-sm btn-primary">-</button>
                    <button class="btn btn-sm btn-danger">+</button>

                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>
