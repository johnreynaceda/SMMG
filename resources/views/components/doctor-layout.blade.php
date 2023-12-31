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
                                @if (auth()->user()->doctor->gender == 'Male')
                                    <img src="{{ asset('images/male-doctor.jpg') }}" class="h-full w-full"
                                        alt="">
                                @else
                                    <img src="{{ asset('images/female-doctor.jpg') }}" class="h-full w-full"
                                        alt="">
                                @endif
                            </div>
                        </div>
                        <center class="my-2 mb-5">
                            <h1 class="font-bold text-white text-lg uppercase">{{ auth()->user()->name }}</h1>
                            <h1 class=" text-gray-200">{{ ucfirst(auth()->user()->account_type) }}</h1>
                        </center>
                        <nav class="flex-1 space-y-1 mt-10">

                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('doctor.dashboard') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('doctor.dashboard') }}">
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
                                    <a class="{{ request()->routeIs('doctor.calendar') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('doctor.calendar') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M17.841 15.659L18.017 15.836L18.1945 15.659C19.0732 14.7803 20.4978 14.7803 21.3765 15.659C22.2552 16.5377 22.2552 17.9623 21.3765 18.841L18.0178 22.1997L14.659 18.841C13.7803 17.9623 13.7803 16.5377 14.659 15.659C15.5377 14.7803 16.9623 14.7803 17.841 15.659ZM12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.6651 7.44784 14.1355 11.7508 14.0038L12 14ZM12 1C15.315 1 18 3.685 18 7C18 10.2397 15.4357 12.8776 12.225 12.9959L12 13C8.685 13 6 10.315 6 7C6 3.76034 8.56434 1.12237 11.775 1.00414L12 1ZM12 3C9.78957 3 8 4.78957 8 7C8 9.21043 9.78957 11 12 11C14.2104 11 16 9.21043 16 7C16 4.78957 14.2104 3 12 3Z">
                                            </path>
                                        </svg>
                                        <span class="ml-3">
                                            My Calendar
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('doctor.appointments') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('doctor.appointments') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM11 13V17H6V13H11ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Appoinments
                                        </span>
                                    </a>
                                </li>
                            </ul>
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
                <div class="border-b sticky top-0 z-10 bg-white py-4">
                    <div class="flex justify-between items-center px-10">
                        <h1 class="text-2xl font-bold text-gray-700">Welcome {{ auth()->user()->name }}!</h1>
                        <div class="relative flex-shrink-0 ml-5" @click.away="open = false" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" class="flex space-x-3 items-center group">
                                    @if (auth()->user()->doctor->gender == 'Male')
                                        <img src="{{ asset('images/male-doctor.jpg') }}"
                                            class="h-12 w-12 rounded-full object-cover " alt="">
                                    @else
                                        <img src="{{ asset('images/female-doctor.jpg') }}"
                                            class="h-12 w-12 rounded-full object-cover " alt="">
                                    @endif
                                    <div class="flex space-x-5 items-center ">
                                        <div class="flex flex-col text-left">
                                            <h1 class="font-bold group-hover:text-blue-700 uppercase">
                                                {{ auth()->user()->name }}</h1>
                                            <span
                                                class="leading-3 text-gray-500 text-sm">{{ Str::ucfirst(auth()->user()->account_type) }}</span>
                                        </div>
                                        <div>
                                            <svg :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                class="h-6 w-6 fill-gray-500 transition-transform duration-200 transform group-hover:fill-blue-700 rotate-0"">
                                                <path d="M12 16L6 10H18L12 16Z"></path>
                                            </svg>
                                        </div>
                                    </div>


                                </button>
                            </div>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1" style="display: none;">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-500"
                                    role="menuitem" tabindex="-1" id="user-menu-item-0">
                                    Your Profile
                                </a>


                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="#"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                                        id="user-menu-item-2">
                                        Sign out
                                    </a>
                                </form>
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
