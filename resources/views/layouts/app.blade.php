<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/jquery.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen w-screen overflow-x-hidden bg-slate-200 font-sans text-gray-900 antialiased">
    @include('sweetalert::alert')
    @include('components.sidebar')
    <div class="relative ml-56 h-full w-[calc(100vw-14rem)]">
        <div class="{{ Request::is('/') ? ' h-[50vh]' : 'h-[30vh]' }} flex justify-between bg-blue-600 px-10 py-7">
            <h1 class="text-xl font-semibold text-white">{{ $title }}</h1>
            <div class="flex gap-5">
                {{ $search ?? '' }}
                <a href="/profil">
                    <div class="flex items-center gap-2">
                        <h1 class="text-lg text-white">{{ auth()->user()->nama }}</h1>
                        <div class="flex h-12 w-12 items-center justify-between overflow-hidden rounded-full">
                            <img src="{{ auth()->user()->foto ? asset('storage/img/' . auth()->user()->foto) : asset('storage/img/user.png') }}"
                                alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{ $slot }}
    </div>
</body>

</html>