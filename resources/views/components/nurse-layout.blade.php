<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

    <!-- Scripts -->
    @wireUiScripts
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased relative">
    <img src="{{ asset('images/hospital-bg.jpg') }}"
        class="absolute top-0 bottom-0 right-0 left-0 object-cover w-full opacity-10 h-full" alt="">
    <div class="flex h-screen overflow-hidden bg-gray-300">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex relative flex-col w-64">
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-[#617E5B] bg-opacity-50 border-r">
                    <div class="flex flex-col items-center flex-shrink-0 px-4">
                        <a class="text-lg font-semibold tracking-tighter text-black focus:outline-none focus:ring "
                            href="/">
                            <img src="{{ asset('images/logo.png') }}" class="h-10" alt="">
                        </a>
                        <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col flex-grow px-4 mt-5">
                        <div class=" mt-5 grid place-content-center">
                            <div class="h-28 w-28 overflow-hidden bg-white rounded-full">
                                <img src="{{ asset('images/doctor.png') }}" class="h-full w-full" alt="">
                            </div>
                        </div>
                        <center class="my-2 mb-5">
                            <h1 class="font-bold text-white text-lg uppercase">{{ auth()->user()->name }}</h1>
                            <h1 class=" text-gray-200">{{ ucfirst(auth()->user()->account_type) }}</h1>
                        </center>
                        <nav class="flex-1 space-y-1 mt-10">

                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('nurse.dashboard') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('nurse.dashboard') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4ZM12 5C13.018 5 13.9852 5.21731 14.8579 5.60806L13.2954 7.16944C12.8822 7.05892 12.448 7 12 7C9.23858 7 7 9.23858 7 12C7 13.3807 7.55964 14.6307 8.46447 15.5355L7.05025 16.9497L6.89445 16.7889C5.71957 15.5368 5 13.8525 5 12C5 8.13401 8.13401 5 12 5ZM18.3924 9.14312C18.7829 10.0155 19 10.9824 19 12C19 13.933 18.2165 15.683 16.9497 16.9497L15.5355 15.5355C16.4404 14.6307 17 13.3807 17 12C17 11.552 16.9411 11.1178 16.8306 10.7046L18.3924 9.14312ZM16.2426 6.34315L17.6569 7.75736L13.9325 11.483C13.9765 11.6479 14 11.8212 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C12.1788 10 12.3521 10.0235 12.517 10.0675L16.2426 6.34315Z">
                                            </path>
                                        </svg>
                                        <span class="ml-3">
                                            Dashboard
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('nurse.patients') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('nurse.patients') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M18.3643 10.9792C19.9264 12.5413 19.9264 15.0739 18.3643 16.636L12.7075 22.2929C12.317 22.6834 11.6838 22.6834 11.2933 22.2929L5.63642 16.636C4.07432 15.0739 4.07432 12.5413 5.63642 10.9792C7.19851 9.41709 9.73117 9.41709 11.2933 10.9792L11.9997 11.6856L12.7075 10.9792C14.2696 9.41709 16.8022 9.41709 18.3643 10.9792ZM7.05063 12.3934C6.26958 13.1744 6.26958 14.4408 7.05063 15.2218L12.0004 20.1716L16.9501 15.2218C17.7312 14.4408 17.7312 13.1744 16.9501 12.3934C16.1691 11.6123 14.9027 11.6123 14.1203 12.3948L11.9983 14.5126L9.87906 12.3934C9.09801 11.6123 7.83168 11.6123 7.05063 12.3934ZM12.0004 1C14.2095 1 16.0004 2.79086 16.0004 5C16.0004 7.20914 14.2095 9 12.0004 9C9.79124 9 8.00038 7.20914 8.00038 5C8.00038 2.79086 9.79124 1 12.0004 1ZM12.0004 3C10.8958 3 10.0004 3.89543 10.0004 5C10.0004 6.10457 10.8958 7 12.0004 7C13.1049 7 14.0004 6.10457 14.0004 5C14.0004 3.89543 13.1049 3 12.0004 3Z">
                                            </path>
                                        </svg>
                                        <span class="ml-3">
                                            Patients
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('nurse.tasks') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('nurse.tasks') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M11 4H21V6H11V4ZM11 8H17V10H11V8ZM11 14H21V16H11V14ZM11 18H17V20H11V18ZM3 4H9V10H3V4ZM5 6V8H7V6H5ZM3 14H9V20H3V14ZM5 16V18H7V16H5Z">
                                            </path>
                                        </svg>
                                        <span class="ml-3">
                                            Tasks
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <ul class="mb-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li>
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C15.2713 2 18.1757 3.57078 20.0002 5.99923L17.2909 5.99931C15.8807 4.75499 14.0285 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C14.029 20 15.8816 19.2446 17.2919 17.9998L20.0009 17.9998C18.1765 20.4288 15.2717 22 12 22ZM19 16V13H11V11H19V8L24 12L19 16Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Logout
                                        </span>
                                    </a>
                                </li>
                            </form>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <main class="relative flex-1 overflow-y-auto focus:outline-none">
                <div class="border-b sticky top-0 z-50 bg-white py-4">
                    <div class="flex justify-between items-center px-10">
                        <h1 class="text-2xl font-bold text-gray-700">Welcome {{ auth()->user()->name }}!</h1>
                        <div class="flex space-x-3 items-center">
                            <div class="h-14 w-14 rounded-full bg-red-500 overflow-hidden">
                                <img src="{{ asset('images/doctor.png') }}" class="h-full w-full object-cover"
                                    alt="">
                            </div>
                            <div>
                                <h1 class="uppercase font-bold text-gray-700">{{ auth()->user()->name }}</h1>
                                <h1 class="text-sm leading-3">{{ ucfirst(auth()->user()->account_type) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6">
                    <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
                        <!-- === Remove and replace with your own content... === -->
                        <div class="py-4">
                            <header>
                                <h1 class="text-3xl font-black text-gray-700">@yield('title')</h1>
                            </header>
                            <div class="mt-10">
                                {{ $slot }}
                            </div>
                        </div>
                        <!-- === End ===  -->
                    </div>
                </div>
            </main>
        </div>
    </div>
    @livewire('notifications')
    @livewireScripts
    @stack('scripts')

</body>

</html>
