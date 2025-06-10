<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @include('components.admin_css')
        @include('components.admin_js')
        @stack('css')
        <title>@yield('title')</title>
    </head>
    <body id="admin-panel">
        @include('components.header')
        @include('components.admin_nav')
        <div class="container-custom bg-light p-3 mt-4">
            @yield('content')
        </div>
        @stack('js')
    </body>
</html>
