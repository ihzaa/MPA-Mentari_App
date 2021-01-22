@section('page_title','All product')
<div>
    @foreach ($data['items'] as $item)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$item->name}}</h5>
            <p class="card-text">{{$item->price}}</p>
        </div>
    </div>
    @endforeach
</div>

