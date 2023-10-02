<div>
    <div>
        <section class="bg-gray-100">
            <div class="items-center ">
                <div class="justify-center w-full  max-auto">
                    <div class="flex flex-col w-64 mx-auto">
                        <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-white rounded-xl">
                            <div class="flex flex-col flex-grow">
                                <div>
                                    <p class="px-4  text-xs font-semibold text-gray-400 uppercase">
                                        Applications
                                    </p>
                                    <ul>
                                        {{-- <li>
                                            <a class="{{ request()->routeIs('account') || request()->routeIs('my-profile') ? 'bg-gray-100 scale-95 ' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                                href="{{ route('my-profile') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="h-4 w-4">
                                                    <path
                                                        d="M12.0009 17C15.6633 17 18.8659 18.5751 20.608 20.9247L18.766 21.796C17.3482 20.1157 14.8483 19 12.0009 19C9.15346 19 6.6535 20.1157 5.23577 21.796L3.39453 20.9238C5.13673 18.5747 8.33894 17 12.0009 17ZM12.0009 2C14.7623 2 17.0009 4.23858 17.0009 7V10C17.0009 12.6888 14.8786 14.8818 12.2178 14.9954L12.0009 15C9.23945 15 7.00087 12.7614 7.00087 10V7C7.00087 4.31125 9.12318 2.11818 11.784 2.00462L12.0009 2ZM12.0009 4C10.4032 4 9.09721 5.24892 9.00596 6.82373L9.00087 7V10C9.00087 11.6569 10.344 13 12.0009 13C13.5986 13 14.9045 11.7511 14.9958 10.1763L15.0009 10V7C15.0009 5.34315 13.6577 4 12.0009 4Z">
                                                    </path>
                                                </svg>
                                                <span class="ml-4">
                                                    My Profile
                                                </span>
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a class="{{ request()->routeIs('account') || request()->routeIs('my-account') ? 'bg-gray-100 scale-95 ' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                                href="{{ route('account') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="h-4 w-4">
                                                    <path
                                                        d="M12.0009 17C15.6633 17 18.8659 18.5751 20.608 20.9247L18.766 21.796C17.3482 20.1157 14.8483 19 12.0009 19C9.15346 19 6.6535 20.1157 5.23577 21.796L3.39453 20.9238C5.13673 18.5747 8.33894 17 12.0009 17ZM12.0009 2C14.7623 2 17.0009 4.23858 17.0009 7V10C17.0009 12.6888 14.8786 14.8818 12.2178 14.9954L12.0009 15C9.23945 15 7.00087 12.7614 7.00087 10V7C7.00087 4.31125 9.12318 2.11818 11.784 2.00462L12.0009 2ZM12.0009 4C10.4032 4 9.09721 5.24892 9.00596 6.82373L9.00087 7V10C9.00087 11.6569 10.344 13 12.0009 13C13.5986 13 14.9045 11.7511 14.9958 10.1763L15.0009 10V7C15.0009 5.34315 13.6577 4 12.0009 4Z">
                                                    </path>
                                                </svg>
                                                <span class="ml-4">
                                                    My Account
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->routeIs('appointment') ? 'bg-gray-100 scale-95 ' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                                href="{{ route('appointment') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="h-4 w-4">
                                                    <path
                                                        d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM11 13V17H6V13H11ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z">
                                                    </path>
                                                </svg>
                                                <span class="ml-4">
                                                    My Appointments
                                                </span>
                                            </a>
                                        </li>


                                    </ul>
                                    <div class="mt-20 mb-5">
                                        <ul>
                                            <li>
                                                <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                                    href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        class="h-4 w-4">
                                                        <path
                                                            d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM13 13.3551V14H11V12.5C11 11.9477 11.4477 11.5 12 11.5C12.8284 11.5 13.5 10.8284 13.5 10C13.5 9.17157 12.8284 8.5 12 8.5C11.2723 8.5 10.6656 9.01823 10.5288 9.70577L8.56731 9.31346C8.88637 7.70919 10.302 6.5 12 6.5C13.933 6.5 15.5 8.067 15.5 10C15.5 11.5855 14.4457 12.9248 13 13.3551Z">
                                                        </path>
                                                    </svg>
                                                    <span class="ml-4">
                                                        Help
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                                    href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        class="h-4 w-4">
                                                        <path
                                                            d="M5 11H13V13H5V16L0 12L5 8V11ZM3.99927 18H6.70835C8.11862 19.2447 9.97111 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.97111 4 8.11862 4.75527 6.70835 6H3.99927C5.82368 3.57111 8.72836 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C8.72836 22 5.82368 20.4289 3.99927 18Z">
                                                        </path>
                                                    </svg>
                                                    <span class="ml-4">
                                                        Logout
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
