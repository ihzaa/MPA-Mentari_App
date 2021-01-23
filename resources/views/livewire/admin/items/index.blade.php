@section('page_title','All product')
<div>
    <div>
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    {{-- @include('livewire.admin.items.create-and-update') --}}
    <div class="row mb-2">
        <div class="col-md-2 d-flex">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="paginate">Jumlah</label>
                </div>
                <select class="custom-select" wire:model="paginate" id="paginate">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group mb-3">
                <input type="text" wire:model="search" class="form-control" placeholder="Cari nama item">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            {{-- @yield('btn-tambah') --}}
            <button class="btn btn-primary btn-block" wire:click="openModalTambah"><i class="fas fa-plus"></i>
                Tambah Item</button>
        </div>
    </div>
    <div class="card-columns">

        @foreach ($data['items'] as $item)
        <div class="card">
            <img class="card-img-top" loading="lazy" src="{{asset('backend\dist\img\prod-1.jpg')}}" alt="Card image cap">
            <div class="card-body">
                {{-- <div class="row"> --}}
                <h5 class="card-title">{{$item->name}}</h5>
                <p class="card-text">
                    <small class="text-muted">
                        Harga: Rp. {{number_format($item->price,0,",",".")}}
                    </small>
                </p>
            </div>
            <div class="card-footer d-flex">
                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                <div class="ml-auto">
                    @if ($isDelete && $item->id === $delete_id)
                    @livewire('admin.items.delete')
                    @else
                    <button class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$item->id}})"><i
                            class="fas fa-trash"></i></button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row d-flex">
        <div class="col-auto mx-auto">
            {{$data['items']->links()}}
        </div>
    </div>
    @include('livewire.admin.items.create')
</div>

@section('cssAfter')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />
@endsection

@section('jsBefore')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection



@section('jsAfter')
{{-- FROM CREATE --}}
<script>
    window.livewire.on('jsOpenModal', () => {
        $('#modal_utama').modal('show');
    });
    window.livewire.on('jsCloseModal', () => {
        $('#modal_utama').modal('hide');
    });
</script>

{{-- FOR ALERT --}}
<script>
    this.livewire.on('swal:alert', data => {
                $(document).Toasts('create', {
                    class: data.icon,
                    title: data.title,
                    body: data.body,
                    autohide: true,
                    delay: 5000
                })
            })
</script>
@endsection
