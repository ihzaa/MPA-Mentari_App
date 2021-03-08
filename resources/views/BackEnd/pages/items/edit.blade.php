@extends('BackEnd.templates.all')
@section('page_title', 'Edit Item')
@section('cssAfter')
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <li class=" breadcrumb-item "><a href=" {{ route('admin_kategori_get') }}">Kategori</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin_list.item.category', ['id' => $data['category_id']]) }}">Item</a>
    </li>
    <li class="breadcrumb-item active">Edit Item</li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="formSatuSatunya"
                            action="{{ route('admin_list.edit.post', ['id' => $data['category_id'], 'id_item' => $data['item']->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Item <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $data['item']->name }}" id="name" name="name" placeholder="Nama Item">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="price">Harga<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" min="0" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ $data['item']->price }}" placeholder="Harga" id="price"
                                            name="price">
                                    </div>
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="promo">Harga promo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" min="0" class="form-control @error('promo') is-invalid @enderror"
                                            value="{{ $data['item']->promo }}" placeholder="Harga promo" id="promo"
                                            name="promo">
                                    </div>
                                    @error('promo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock">Stok<span class="text-danger">*</span></label>
                                        <input type="number" min="0"
                                            class="form-control @error('stock') is-invalid @enderror"
                                            value="{{ $data['item']->stock }}" id="stock" name="stock"
                                            placeholder="Stok">
                                    </div>
                                    @error('stock')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                                    placeholder="Deskripsi" name="description"
                                    id="description">{{ $data['item']->description }}</textarea>
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                        <label>Gambar Item <a href="javascript:void(0)"
                                                class="custom-file-container__image-clear"
                                                title="Clear Image">&times;</a></label>
                                        <br>
                                        <ul>
                                            <li><small>Dapat lebih dari 1</small></li>
                                            <li><small>Jika lebih dari satu gambar, <strong>pilih langsung bersamaan dengan
                                                        cara menekan CTRL dan klik FOTO</strong></small></li>
                                            <li><small>Harus berformat gambar (jpg, png, jpeg, dll)</small></li>
                                        </ul>
                                        <label class="custom-file-container__custom-file">
                                            <input id="images" type="file"
                                                class="custom-file-container__custom-file__custom-file-input"
                                                accept="image/*" multiple aria-label="Choose File" name="images[]">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                    @error('images')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="category">
                                        @foreach ($data['category'] as $d)
                                            <option value="{{ $d->id }}" @if ($d->id == $data['category_id']) selected="selected" @endif>
                                                {{ $d->name }}</option>
                                        @endforeach
                                </div>
                                </select>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                    </div>
                    <textarea name="imagesList" id="imagesList" cols="30" rows="10" hidden></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsAfter')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        let images = @json($data['images']);
        $('#price').mask("#.##0", {
            reverse: true
        });
        $('#promo').mask("#.##0", {
            reverse: true
        });
        var upload = new FileUploadWithPreview('myUniqueUploadId', {
            presetFiles: images,
        })

        $("#formSatuSatunya").submit(function() {
            $("#main_loading").show()
            $("#imagesList").val(JSON.stringify(upload.cachedFileArray))
            console.log($("#imagesList").val());
        })

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    </script>
@endsection
