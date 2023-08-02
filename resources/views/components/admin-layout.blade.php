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
                            <h1 class="font-bold text-white text-lg">JUAN DELA CRUZ</h1>
                            <h1 class=" text-gray-200">Administrator</h1>
                        </center>
                        <nav class="flex-1 space-y-1 mt-10">

                            <ul>
                                <li>
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#">
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
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M17.841 15.659L18.017 15.836L18.1945 15.659C19.0732 14.7803 20.4978 14.7803 21.3765 15.659C22.2552 16.5377 22.2552 17.9623 21.3765 18.841L18.0178 22.1997L14.659 18.841C13.7803 17.9623 13.7803 16.5377 14.659 15.659C15.5377 14.7803 16.9623 14.7803 17.841 15.659ZM12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.6651 7.44784 14.1355 11.7508 14.0038L12 14ZM12 1C15.315 1 18 3.685 18 7C18 10.2397 15.4357 12.8776 12.225 12.9959L12 13C8.685 13 6 10.315 6 7C6 3.76034 8.56434 1.12237 11.775 1.00414L12 1ZM12 3C9.78957 3 8 4.78957 8 7C8 9.21043 9.78957 11 12 11C14.2104 11 16 9.21043 16 7C16 4.78957 14.2104 3 12 3Z">
                                            </path>
                                        </svg>
                                        <span class="ml-3">
                                            Patients
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#">
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
                                <li>
                                    <a class="{{ request()->routeIs('admin.specialization') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('admin.specialization') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M8 3V5H6V9C6 11.2091 7.79086 13 10 13C12.2091 13 14 11.2091 14 9V5H12V3H15C15.5523 3 16 3.44772 16 4V9C16 11.9727 13.8381 14.4405 11.0008 14.9169L11 16.5C11 18.433 12.567 20 14.5 20C15.9973 20 17.275 19.0598 17.7749 17.7375C16.7283 17.27 16 16.2201 16 15C16 13.3431 17.3431 12 19 12C20.6569 12 22 13.3431 22 15C22 16.3711 21.0802 17.5274 19.824 17.8854C19.2102 20.252 17.0592 22 14.5 22C11.4624 22 9 19.5376 9 16.5L9.00019 14.9171C6.16238 14.4411 4 11.9731 4 9V4C4 3.44772 4.44772 3 5 3H8ZM19 14C18.4477 14 18 14.4477 18 15C18 15.5523 18.4477 16 19 16C19.5523 16 20 15.5523 20 15C20 14.4477 19.5523 14 19 14Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Specialization
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <p class="px-4 pt-4 text-xs font-semibold text-gray-800 uppercase">
                                MEDICAL STAFF
                            </p>
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('admin.doctors') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('admin.doctors') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM17.7929 19.9142L21.3284 16.3787L22.7426 17.7929L17.7929 22.7426L14.2574 19.2071L15.6716 17.7929L17.7929 19.9142Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Doctors
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.nurses') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }} inline-flex  items-center w-full px-4 py-2 mt-1    transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="{{ route('admin.nurses') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M12.0006 15C16.0802 15 19.4466 18.0537 19.9387 22H4.0625C4.55458 18.0537 7.92098 15 12.0006 15ZM10.1875 17.2795C8.75387 17.734 7.54637 18.7133 6.80201 20L12.0006 20L10.1875 17.2795ZM13.8141 17.2797L12.0006 20L17.1992 20C16.4549 18.7135 15.2476 17.7342 13.8141 17.2797ZM18.0006 2V8C18.0006 11.3137 15.3143 14 12.0006 14C8.6869 14 6.00061 11.3137 6.00061 8V2H18.0006ZM8.00061 8C8.00061 10.2091 9.79147 12 12.0006 12C14.2098 12 16.0006 10.2091 16.0006 8H8.00061ZM16.0006 4H8.00061L8.0005 6H16.0005L16.0006 4Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Nurses
                                        </span>
                                    </a>
                                </li>



                            </ul>
                            <div class="border-t w-full"></div>
                            <ul>
                                <li>
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M11 7H13V17H11V7ZM15 11H17V17H15V11ZM7 13H9V17H7V13ZM15 4H5V20H19V8H15V4ZM3 2.9918C3 2.44405 3.44749 2 3.9985 2H16L20.9997 7L21 20.9925C21 21.5489 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5447 3 21.0082V2.9918Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Reports
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM13 13.3551V14H11V12.5C11 11.9477 11.4477 11.5 12 11.5C12.8284 11.5 13.5 10.8284 13.5 10C13.5 9.17157 12.8284 8.5 12 8.5C11.2723 8.5 10.6656 9.01823 10.5288 9.70577L8.56731 9.31346C8.88637 7.70919 10.302 6.5 12 6.5C13.933 6.5 15.5 8.067 15.5 10C15.5 11.5855 14.4457 12.9248 13 13.3551Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            About
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="inline-flex  items-center w-full px-4 py-2 mt-1  text-white fill-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100  hover:scale-95 hover:text-gray-700 hover:fill-gray-700"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                            <path
                                                d="M19.9381 8H21C22.1046 8 23 8.89543 23 10V14C23 15.1046 22.1046 16 21 16H19.9381C19.446 19.9463 16.0796 23 12 23V21C15.3137 21 18 18.3137 18 15V9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9V16H3C1.89543 16 1 15.1046 1 14V10C1 8.89543 1.89543 8 3 8H4.06189C4.55399 4.05369 7.92038 1 12 1C16.0796 1 19.446 4.05369 19.9381 8ZM3 10V14H4V10H3ZM20 10V14H21V10H20ZM7.75944 15.7849L8.81958 14.0887C9.74161 14.6662 10.8318 15 12 15C13.1682 15 14.2584 14.6662 15.1804 14.0887L16.2406 15.7849C15.0112 16.5549 13.5576 17 12 17C10.4424 17 8.98882 16.5549 7.75944 15.7849Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Services
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
                <div class="border-b sticky top-0 z-10 bg-white py-4">
                    <div class="flex justify-between items-center px-10">
                        <h1 class="text-2xl font-bold text-gray-700">Welcome {{ auth()->user()->name }}!</h1>
                        <div class="flex space-x-3 items-center">
                            <div class="h-14 w-14 rounded-full bg-red-500 overflow-hidden">
                                <img src="{{ asset('images/doctor.png') }}" class="h-full w-full object-cover"
                                    alt="">
                            </div>
                            <div>
                                <h1 class="uppercase font-bold text-gray-700">{{ auth()->user()->name }}</h1>
                                <h1 class="text-sm leading-3">{{ auth()->user()->account_type }}</h1>
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

</body>

</html>
