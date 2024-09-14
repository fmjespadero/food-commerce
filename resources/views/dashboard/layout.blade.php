<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body>
    @extends('adminlte::page')
    {{-- Extend and customize the browser title --}}

    @section('title')
        {{ config('adminlte.title') }}
        @hasSection('subtitle') | @yield('subtitle') @endif
    @stop

    {{-- Extend and customize the page content header --}}

    @section('content_header')
        @hasSection('content_header_title')
            <h1 class="text-muted">
                @yield('content_header_title')

                @hasSection('content_header_subtitle')
                    <small class="text-dark">
                        <i class="fas fa-xs fa-angle-right text-muted"></i>
                        @yield('content_header_subtitle')
                    </small>
                @endif
            </h1>
        @endif
    @stop

    {{-- Rename section content to content_body --}}

    @section('content')
        @yield('content_body')
    @stop

    {{-- Create a common footer --}}

    @section('footer')
        <div class="float-right">
            Version: {{ config('app.version', '1.0.0') }}
        </div>

        <strong>
            <a href="{{ config('app.company_url', '#') }}">
                {{ config('app.company_name', 'Food E-commerce') }}
            </a>
        </strong>
    @stop

    {{-- Add common Javascript/Jquery code --}}

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {
                // Get the height of the .main-header element
                const headerHeight = $('.main-header').height();
                const footerHeight = $('.main-footer').height();

                // Set the height of the .content element
                $('.content-wrapper').css({
                    'height': 'calc(100vh - ' + headerHeight + footerHeight + 'px)'
                });

                $('.sidebar').css({
                    'height': 'calc(100vh - ' + headerHeight + 'px)'
                })
            });
        </script>
    @endpush

    {{-- Add common CSS customizations --}}

    @push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <style type="text/css">
        
        {{-- You can add AdminLTE customizations here --}}

        .content-wrapper{
            overflow-y: scroll;
        }
        .sidebar{
            overflow: scroll;
        }
    </style>
    @endpush
    </body>
</html>
