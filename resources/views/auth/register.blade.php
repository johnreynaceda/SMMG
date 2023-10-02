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

    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased h-full relative">

    <div class="flex min-h-full bg-gray-800">
        <img class="absolute inset-0  opacity-30 h-full w-full object-cover" src="{{ asset('images/hospital-bg.jpg') }}"
            alt="">
        <div class="relative hidden w-0 flex-1 lg:block">
            {{-- <img class="absolute inset-0 h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80"
                alt=""> --}}
        </div>
        <div
            class="flex flex-1 flex-col relative justify-center bg-gray-700 bg-opacity-80 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 ">
            <div class="mx-auto w-full  max-w-lg lg:w-[60rem]">
                <div>
                    <img class="h-20  rounded-full w-auto" src="{{ asset('images/LOGO.png') }}" class=""
                        alt="Your Company">
                    <h2 class="mt-3 text-2xl text-center font-bold leading-9 tracking-tight text-main text-white">CREATE
                        YOUR
                        ACCOUNT</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-200">
                        Please input your data correctly.
                    </p>
                </div>

                <div class="mt-10">
                    <div>
                        <x-validation-errors class="mb-4" />

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Name
                                </label>
                                <div class="mt-2">
                                    <x-input icon="user" id="email" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Email
                                </label>
                                <div class="mt-2">
                                    <x-input icon="user" id="email" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Phone
                                    Number
                                </label>
                                <div class="mt-2">
                                    <x-input icon="user" id="email" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                </div>
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-100">Password</label>
                                <div class="mt-2">
                                    <x-inputs.password icon="key" id="password" type="password" name="password"
                                        required autocomplete="current-password" />
                                </div>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-100">Confirm
                                    Password</label>
                                <div class="mt-2">
                                    <x-inputs.password icon="key" id="password" type="password" name="password"
                                        required autocomplete="current-password" />
                                </div>
                            </div>



                            <div>
                                <button>
                                    <x-button type="submit" rounded label="Create Account" md class="w-full font-bold"
                                        negative right-icon="arrow-right" />
                                </button>
                                <div class="mt-2 text-center">
                                    <p class="text-white">Already have an account? <a href="{{ route('login') }}"
                                            class="hover:text-green-500"> Sign In</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @livewireScripts
</body>

</html>
