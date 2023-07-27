{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}
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
            <div class="mx-auto w-full max-w-lg lg:w-[60rem]">
                <div>
                    <img class="h-20  rounded-full w-auto" src="{{ asset('images/LOGO.png') }}" class=""
                        alt="Your Company">
                    <h2 class="mt-3 text-2xl font-bold leading-9 tracking-tight text-main text-white">Welcome to
                        MMG-BULAN</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-200">
                        Enter a valid account to continue signing in.
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
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Phone
                                    Number</label>
                                <div class="mt-2">
                                    <x-input icon="user" id="phone_number" type="number" name="phone_number"
                                        :value="old('phone_number')" required autofocus autocomplete="phone_number" />
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

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-100">Remember
                                        me</label>
                                </div>

                                <div class="text-sm leading-6">
                                    <a href="#"
                                        class="font-semibold text-gray-400 text-main hover:text-gray-100">Forgot
                                        password?</a>
                                </div>
                            </div>

                            <div>
                                <button>
                                    <x-button type="submit" rounded label="Sign In" md class="w-full font-bold"
                                        negative right-icon="login" />
                                </button>
                                <div class="mt-2 text-center">
                                    <p class="text-white">Don't have an account? <a href="{{ route('new-account') }}"
                                            class="hover:text-green-500"> Sign Up</a></p>
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
