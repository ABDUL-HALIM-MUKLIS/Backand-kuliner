<x-template.default>
    <x-slot name="title">Tambah Tempat Kuliner</x-slot>

    <div class="card">
        <form action="{{ route('place.store') }}" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <h1 class="card-title">Enter your Location Kuliner</h1>
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
                    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Input description location" value="{{ old('description') }}"></textarea>
                    @error('description')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="sub_district_id">Kecamatan</label>
                    <select name="sub_district_id" class="form-control @error('sub_district_id') is-invalid @enderror">
                        @foreach($subDistricts as $subDistrict)
                            <option value="{{ $subDistrict->id }}">{{ $subDistrict->name }}</option>
                        @endforeach
                    </select>
                    @error('sub_district_id')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="address">Address</label>
                    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Input address location" value="{{ old('address') }}"></textarea>
                    @error('address')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Input phone location" value="{{ old('phone') }}">
                    @error('phone')
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
                <div class="form-group mt-2">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div id="map"></div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" placeholder="Input latitude location" value="{{ old('latitude') }}" readonly>
                            @error('latitude')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="longitude">longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" placeholder="Input longitude location" value="{{ old('longitude') }}" readonly>
                            @error('longitude')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="crossorigin=""/>
        <style>
            #map { height: 250px; }
        </style>
    @endpush

    @push('extra-script')
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>

        <script>
            var map = L.map('map').fitWorld();

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiaGFsaW0taXQiLCJhIjoiY2wxNTNibGJiMGQ2eTNkcnZtczk0b2h0ciJ9._raqy4Au5-tIQry1Zx_1UQ'
            }).addTo(map);
            map.locate({setView: true, maxZoom: 16});

            function onLocationFound(e) {
                var radius = e.accuracy;

                //mengisi latitude dan logitude pada form
                $('#latitude').val(e.latlng.lat)
                $('#longitude').val(e.latlng.lng)

                var locationMaker = L.marker(e.latlng,{ draggable:'true'}).addTo(map);

                locationMaker.on('dragend',function (event){
                    var marker = event.target;
                    // console.log(marker);
                    var position = marker.getLatLng();

                    marker.setLatLng(position, {draggable : 'true'}).update();
                    $('#latitude').val(position.lat)
                    $('#longitude').val(position.lng)
                })
                    
            }

            
            function onLocationError(e) {
                alert(e.message);
            }
            
            map.on('locationfound', onLocationFound);
            map.on('locationerror', onLocationError);
            var marker = L.marker([51.5, -0.09]).addTo(map);
        </script>
    @endpush
</x-template.default>