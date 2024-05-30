<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- fa --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>


<body class="vh-100 m-0">

    <div id="app" class="h-100">
        <div class="wrapper d-flex h-100">

            {{-- SIDEBAR --}}
            @include('admin.partials.sidebar')

            <main class=" main-admin h-100 w-100 overflow-y-hidden">
                {{-- top-bar --}}
                @include('admin.partials.navbar')

                {{-- content --}}
                <div class="content-wrapper p-4 h-100 overflow-y-scroll">
                    @yield('content')
                </div>
            </main>




        </div>




    </div>
</body>

</html>
