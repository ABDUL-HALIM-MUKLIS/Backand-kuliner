>STEP 1 INSTALL LARAVEL DAN MENYIAPKAN DATABASE
- Instalasi Laravel

- Membuat tabel
```
    php artisan make:model nama-model -m
```
- Menambah inisialisasi pada folder Models/SubDistrict.php
```php
    public $timestamp = false;
```
- membuat database kulinersiduarjo dan setting pada .env
- menjalankan migrasi untuk membaut tabel dari laravel
```
    php artisan migrate
```

>STEP 2 Memilih tabel admin
>STEP 3 Tampalting building

>STEP 4 fungsi LOGIN
- Mengunakan pakage tambahan yaitu [Laravel Fortify](https://laravel.com/docs/9.x/fortify)
```
    composer require laravel/fortify
```
```
    php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
```
```
php artisan migratephp artisan migrate
```
- Meng aktifkan fitur yang akan di gunakan di fortify difoler config/fortify.php
```php
    'features' => [
        // Features::registration(),
        Features::resetPasswords(),
        // Features::emailVerification(),
        // Features::updateProfileInformation(),
        // Features::updatePasswords(),
        // Features::twoFactorAuthentication([
        //     // 'confirm' => true,
        //     'confirmPassword' => true,
        // ]),
    ],
```
- Menambah auth login pada folder Providers/fortyfyServiceProvider.php

- Mendaftarkan class fortyfy pada folder config/app.php
```php
        /*
         * Package Service Providers...
         */
        \App\Providers\FortifyServiceProvider::class,
```
- Mengatur tampilan login menambah inputan dan tombol, menambah action form ke rute login dan metod post
- Membuat seeder data admin
```
    php artisan make:seeder nama-seeder
```
```php
public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kuliner.com',
            'password' => bcrypt('password'),
        ]);
    }
```
- Menjalanakan seeder
```
    php artisan db:seed --class=nama-file-seeder
```

> STEP 5 MIDDELWARE

- Melihat route pada backand
```
    php artisan route:list --compact
```
- Membuat fungsi logout dengan membuat tombol atau link yang dapat di tekan, membuat event click pada tombol tersebut dan merequest url logout dengan metode POST beserta mengirim csrt token pada Laravel.
```js
    <script>
      const btnlogout = document.getElementById("logout");
      btnlogout.addEventListener("click", function(e){
        e.preventDefault()
        $.ajax({
          type: 'POST',
          url: 'logout',
          data: {
            '_token': "{{csrf_token()}}"
          },
          success: function(respone) {
            window.location.href = '/'
          },
        })
      })
      
    </script>
```
> STEP 6 SEEDER KECAMATAN
- Membuat seeder SubDistricSeeder untuk kecamatan

> SETP 7 Menampilkan data kecamatan pada web
- Menginstall datatabel dengan mengunakan [yajra](https://yajrabox.com/docs/laravel-datatables/master/installation)
```
    composer require yajra/laravel-datatables-oracle:"~9.0"
```
```
    php artisan vendor:publish --tag=datatables
```
> SETP 8 Menampilkan data category
>SETEP 9 Menambah data Category
- Membuat form inputan
- Menambah validasi inputan pada controller
- Menampung data dan di inputkan pada database 
- Redirect ke tampilan Category.index

- Setting 
```php
    use Illuminate\Database\Eloquen\Model;

    public function boot()
    {
        Model::unguard();//
    }
```

> STEP 10 Membuat Edit Category
> STEP 11 Membuat Delete CATEGORY
> step 12 Membuat tampilan data tempat kuliner
> STEP 13 Tambah data tempat kuliner
> STEP 14 Tambah data tempat kuliner dengan MAP
- Menambah data dengan map mengunakan [Mapbox](https://www.mapbox.com/) agar mendapat API 
- Menambah Map pada script dengan mengunakan [Leaflet](https://leafletjs.com/)

```html
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <style>
        #map { height: 250px; }
    </style>
    
    <div id="map"></div>


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
```

> STEP 15 Edite data tempat kuliner dengan map
- Sama seperti Tambah data namun ada beberapa hal yang berbeda pada script map
```html

    <script>
            var map = L.map('map').setView([{{ $place->latitude }}, {{ $place->longitude }}], 13);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiaGFsaW0taXQiLCJhIjoiY2wxNTNibGJiMGQ2eTNkcnZtczk0b2h0ciJ9._raqy4Au5-tIQry1Zx_1UQ'
            }).addTo(map);
            
            var marker = L.marker([{{ $place->latitude }}, {{ $place->longitude }}], {draggable : 'true'}).addTo(map);

            marker.on('dragend',function (event){
                var marker = event.target;
                // console.log(marker);
                var position = marker.getLatLng();

                marker.setLatLng(position, {draggable : 'true'}).update();
                $('#latitude').val(position.lat)
                $('#longitude').val(position.lng)
            })

            function onLocationError(e) {
                alert(e.message);
            }
        </script>
```

> STEP 16 Membuat Hapus Data tempat kuliner sama seperti menghapus kategori
> STEP 17 Membenearkan UX menu active,index data urut 123..., 
> STEP 18 Membuat menu dari tempat kuliner
> STEP 19 Membuat tambah data menu dan meng hendel penyimpanan file public
- Pada folder config/filesystems ubah seperti di bawah
```php
    'public' => [
            'driver' => 'local',
            'root' => public_path(),  //<----------
            'url' => env('APP_URL'),  //<----------
            'visibility' => 'public',
        ],
```
- Pada .env ubah 
```env
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DRIVER=public    <---------
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
```

> STEP 20 
- Cara clear cach pada beberapa hal di laravel
```
    php artisan cache:clear
    php artisan route:cache
    php artisan config:cache
    php artisan view:clear
```

> STEP 22 Evaluasi
- Membuat keamanan scop untuk agar user tidak mengotak atik url agar jika user menganti id pada url akan tidak bisa jika id tersebut tidak ada

```php
    Route::resource('/place/{place}/menu', App\Http\Controllers\PlaceMenuController::class)->scoped();
``