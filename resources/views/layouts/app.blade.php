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
    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            display: flex;

        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <footer class=" bg-gray-900 " aria-labelledby="footer-heading">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8 lg:py-32">
                <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                    <div>
                        <img class="h-20" src="{{ asset('images/logo.png') }}" alt="Company name">
                        <h1 class="mt-3 text-lg text-white font-medium">MMG-BULAN</h1>
                    </div>
                    <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 class="text-xl font-semibold leading-6 text-white">Get in Touch</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <p class="text-white">the quick fox jumps over the lazy dog</p>
                                    </li>
                                    <li class="flex items-end space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            class="h-5 w-5 fill-white">
                                            <path
                                                d="M12.001 2C6.47813 2 2.00098 6.47715 2.00098 12C2.00098 16.9913 5.65783 21.1283 10.4385 21.8785V14.8906H7.89941V12H10.4385V9.79688C10.4385 7.29063 11.9314 5.90625 14.2156 5.90625C15.3097 5.90625 16.4541 6.10156 16.4541 6.10156V8.5625H15.1931C13.9509 8.5625 13.5635 9.33334 13.5635 10.1242V12H16.3369L15.8936 14.8906H13.5635V21.8785C18.3441 21.1283 22.001 16.9913 22.001 12C22.001 6.47715 17.5238 2 12.001 2Z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            class="h-5 w-5 fill-white">
                                            <path
                                                d="M13.0281 2.00098C14.1535 2.00284 14.7238 2.00879 15.2166 2.02346L15.4107 2.02981C15.6349 2.03778 15.8561 2.04778 16.1228 2.06028C17.1869 2.10944 17.9128 2.27778 18.5503 2.52528C19.2094 2.77944 19.7661 3.12278 20.3219 3.67861C20.8769 4.23444 21.2203 4.79278 21.4753 5.45028C21.7219 6.08694 21.8903 6.81361 21.9403 7.87778C21.9522 8.14444 21.9618 8.36564 21.9697 8.58989L21.976 8.78397C21.9906 9.27672 21.9973 9.8471 21.9994 10.9725L22.0002 11.7182C22.0003 11.8093 22.0003 11.9033 22.0003 12.0003L22.0002 12.2824L21.9996 13.0281C21.9977 14.1535 21.9918 14.7238 21.9771 15.2166L21.9707 15.4107C21.9628 15.6349 21.9528 15.8561 21.9403 16.1228C21.8911 17.1869 21.7219 17.9128 21.4753 18.5503C21.2211 19.2094 20.8769 19.7661 20.3219 20.3219C19.7661 20.8769 19.2069 21.2203 18.5503 21.4753C17.9128 21.7219 17.1869 21.8903 16.1228 21.9403C15.8561 21.9522 15.6349 21.9618 15.4107 21.9697L15.2166 21.976C14.7238 21.9906 14.1535 21.9973 13.0281 21.9994L12.2824 22.0002C12.1913 22.0003 12.0973 22.0003 12.0003 22.0003L11.7182 22.0002L10.9725 21.9996C9.8471 21.9977 9.27672 21.9918 8.78397 21.9771L8.58989 21.9707C8.36564 21.9628 8.14444 21.9528 7.87778 21.9403C6.81361 21.8911 6.08861 21.7219 5.45028 21.4753C4.79194 21.2211 4.23444 20.8769 3.67861 20.3219C3.12278 19.7661 2.78028 19.2069 2.52528 18.5503C2.27778 17.9128 2.11028 17.1869 2.06028 16.1228C2.0484 15.8561 2.03871 15.6349 2.03086 15.4107L2.02457 15.2166C2.00994 14.7238 2.00327 14.1535 2.00111 13.0281L2.00098 10.9725C2.00284 9.8471 2.00879 9.27672 2.02346 8.78397L2.02981 8.58989C2.03778 8.36564 2.04778 8.14444 2.06028 7.87778C2.10944 6.81278 2.27778 6.08778 2.52528 5.45028C2.77944 4.79194 3.12278 4.23444 3.67861 3.67861C4.23444 3.12278 4.79278 2.78028 5.45028 2.52528C6.08778 2.27778 6.81278 2.11028 7.87778 2.06028C8.14444 2.0484 8.36564 2.03871 8.58989 2.03086L8.78397 2.02457C9.27672 2.00994 9.8471 2.00327 10.9725 2.00111L13.0281 2.00098ZM12.0003 7.00028C9.23738 7.00028 7.00028 9.23981 7.00028 12.0003C7.00028 14.7632 9.23981 17.0003 12.0003 17.0003C14.7632 17.0003 17.0003 14.7607 17.0003 12.0003C17.0003 9.23738 14.7607 7.00028 12.0003 7.00028ZM12.0003 9.00028C13.6572 9.00028 15.0003 10.3429 15.0003 12.0003C15.0003 13.6572 13.6576 15.0003 12.0003 15.0003C10.3434 15.0003 9.00028 13.6576 9.00028 12.0003C9.00028 10.3434 10.3429 9.00028 12.0003 9.00028ZM17.2503 5.50028C16.561 5.50028 16.0003 6.06018 16.0003 6.74943C16.0003 7.43867 16.5602 7.99944 17.2503 7.99944C17.9395 7.99944 18.5003 7.43954 18.5003 6.74943C18.5003 6.06018 17.9386 5.49941 17.2503 5.50028Z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            class="h-5 w-5 fill-white">
                                            <path
                                                d="M22.2125 5.65605C21.4491 5.99375 20.6395 6.21555 19.8106 6.31411C20.6839 5.79132 21.3374 4.9689 21.6493 4.00005C20.8287 4.48761 19.9305 4.83077 18.9938 5.01461C18.2031 4.17106 17.098 3.69303 15.9418 3.69434C13.6326 3.69434 11.7597 5.56661 11.7597 7.87683C11.7597 8.20458 11.7973 8.52242 11.8676 8.82909C8.39047 8.65404 5.31007 6.99005 3.24678 4.45941C2.87529 5.09767 2.68005 5.82318 2.68104 6.56167C2.68104 8.01259 3.4196 9.29324 4.54149 10.043C3.87737 10.022 3.22788 9.84264 2.64718 9.51973C2.64654 9.5373 2.64654 9.55487 2.64654 9.57148C2.64654 11.5984 4.08819 13.2892 6.00199 13.6731C5.6428 13.7703 5.27232 13.8194 4.90022 13.8191C4.62997 13.8191 4.36771 13.7942 4.11279 13.7453C4.64531 15.4065 6.18886 16.6159 8.0196 16.6491C6.53813 17.8118 4.70869 18.4426 2.82543 18.4399C2.49212 18.4402 2.15909 18.4205 1.82812 18.3811C3.74004 19.6102 5.96552 20.2625 8.23842 20.2601C15.9316 20.2601 20.138 13.8875 20.138 8.36111C20.138 8.1803 20.1336 7.99886 20.1256 7.81997C20.9443 7.22845 21.651 6.49567 22.2125 5.65605Z">
                                            </path>
                                        </svg>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-10 md:mt-0">
                                <h3 class="text-xl font-semibold leading-6 text-white">Company Info</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">About
                                            Us</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Carrier</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">We
                                            are hiring</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Blog</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 class="text-xl font-semibold leading-6 text-white">Features</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Business
                                            Marketing</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">User
                                            Analytic</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Live
                                            Chatr</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Unlimited
                                            Support</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="mt-10 md:mt-0">
                                <h3 class="text-xl font-semibold leading-6 text-white">Resources</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">IOS
                                            $ Android</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Watch
                                            a Demo</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Customers</a>

                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">API</a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
