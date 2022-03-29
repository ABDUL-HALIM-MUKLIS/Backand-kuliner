<x-template.default>
    <x-slot name="title">Tambah Menu Kuliner</x-slot>

    <div class="card">
        <form action="{{ route('menu.store',$place) }}" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <h1 class="card-title">Enter your Menu Kuliner</h1>
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name location" value="{{ old('name') }}">
                    @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="description">Description</label>
                    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Input description location" value="">{{ old('description') }}</textarea>
                    @error('description')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="categori_id">Kategori</label>
                    <select name="categori_id" class="form-control @error('categori_id') is-invalid @enderror">
                        @foreach($categoris as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categori_id')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Input price location" value="{{ old('price') }}">
                    @error('price')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Input image location" value="{{ old('image') }}">
                    @error('image')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                
                {{-- <div class="form-group mt-2">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Input Price location" value="{{ old('price') }}">
                    @error('price')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div> --}}
                
            </div>
            <div class="card-footer">
                <div class="float-end mb-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('place.index') }}" class="btn btn-warning">Cancle</a>
                </div>
            </div>
        </form>
    </div>

    @push('extra-style')

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="crossorigin=""/>
        
    @endpush

    @push('extra-script')
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
    @endpush
</x-template.default>