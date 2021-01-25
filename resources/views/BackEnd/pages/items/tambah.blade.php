@extends('BackEnd.templates.all')
@section('page_title','Tambah Item')
@section('cssAfter')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item "><a href="{{route('admin_kategori_get')}}">Kategori</a></li>
<li class="breadcrumb-item"><a href="{{route('admin_list.item.category',['id'=>$data['category_id']])}}">Item</a></li>
<li class="breadcrumb-item active">Tambah Item</li>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin_list.add.post',['id'=>$data['category_id']])}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Item <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{old('name')}}" id="name" name="name" placeholder="Nama Item">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            <div class="col-md-6">
                                <label for="price">Harga<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" min="0" class="form-control @error('price') is-invalid @enderror"
                                        value="{{old('price')}}" placeholder="Harga" id="price" name="price">
                                </div>
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stok<span class="text-danger">*</span></label>
                                    <input type="number" min="0"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{old('stock')}}" id="stock" name="stock" placeholder="Stok">
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
                                id="description">{{old('description')}}</textarea>
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
                                    <ul>
                                        <li><small>Dapat lebih dari 1 gambar</small></li>
                                        <li><small>Jika lebih dari satu gambar, <strong>pilih langsung bersamaan</strong></small></li>
                                        <li><small>Harus berformat gambar (jpg, png, jpeg, dll)</small></li>
                                    </ul>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" class="custom-file-container__custom-file__custom-file-input"
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
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsAfter')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<script>
    $('#price').mask("#.##0", {reverse: true});
    var upload = new FileUploadWithPreview('myUniqueUploadId')
</script>
@endsection
