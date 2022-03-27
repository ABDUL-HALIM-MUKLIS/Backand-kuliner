<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta6
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{config('app.name')}}</title>
    <!-- CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    {{-- <link href="{{ asset('dist/css/demo.min.css')}}" rel="stylesheet"/> --}}
    @stack('extra-style')
  </head>
  <body >
    <div class="page">
        @include('components.template.partials.navbar');
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  {{$title ?? 'Dashboard'}}
                </h2>
              </div>
              <!-- Page title actions -->
              {{-- <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="#" class="btn btn-white">
                      New view
                    </a>
                  </span>
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Create new report
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  </a>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <x-forms.alert></x-forms.alert>
                {{ $slot }}
          </div>
            {{-- @include('components.template.partials.content') --}}
        </div>
            @include('components.template.partials.footer')
      </div>
    </div>
    <!-- Libs JS -->
    {{-- <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js')}}"></script> --}}
    <!-- Tabler Core -->
    {{-- <script src="{{ asset('dist/js/tabler.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('dist/js/demo.min.js')}}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

    @stack('extra-script')
    
  </body>
</html>