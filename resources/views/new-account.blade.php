<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased h-full relative">

    <div class="flex min-h-full ">
        <img class="fixed inset-0 hidden 2xl:block h-full w-full object-cover"
            src="{{ asset('images/hospital-bg.jpg') }}" alt="">
        <div class="relative hidden w-0 2xl:flex-1 lg:block">
            {{-- <img class="absolute inset-0 h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80"
                alt=""> --}}
        </div>

        <div class="flex-1 2xl:flex-none">
            <livewire:create-account />
        </div>

    </div>
    @stack('scripts')
    @livewireScripts
    <x-dialog z-index="z-50" blur="md" align="center" />
</body>

</html>
