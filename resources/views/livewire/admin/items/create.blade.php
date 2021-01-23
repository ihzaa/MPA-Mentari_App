<div>
    <div wire:ignore.self id="modal_utama" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_utama_title">{{$modalTitle}}</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama Item" wire:model="name">
                            @error('name')
                            <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label for="">Harga <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id=""
                                placeholder="Harga" wire:model="price">
                            @error('price')
                            <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id=""
                                placeholder="Stok" wire:model="stock">
                            @error('stock')
                            <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi <span class="text-danger ">*</span></label>
                        <textarea name="" id="" cols="30" rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                            wire:model="description"></textarea>
                        @error('description')
                        <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                    <span class="text-danger">*</span>: Wajib diisi
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="storeItem" class="btn btn-sm btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @section('btn-tambah')
<button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_utama"><i class="fas fa-plus"></i>
    Tambah Item</button>
@endsection --}}

{{-- @section('jsAfter')
<script>
    window.livewire.on('jsOpenModal', () => {
        $('#modal_utama').modal('show');
    });
    window.livewire.on('jsCloseModal', () => {
        $('#modal_utama').modal('hide');
    });
</script>
@endsection --}}
