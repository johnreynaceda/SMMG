<div x-data="{ modelOpen: @entangle('modal_open') }">
    <div
        class="flex flex-1 h-full flex-col relative justify-center bg-gray-700 bg-opacity-90 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 ">
        <div class="mx-auto w-full max-w-lg lg:w-[60rem]">
            <div>
                <img class="h-20  rounded-full w-auto" src="{{ asset('images/LOGO.png') }}" class=""
                    alt="Your Company">
                <h2 class="mt-3 text-2xl font-bold leading-9 tracking-tight text-main text-white">CREATE YOUR
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
                                <x-input icon="user" type="text" wire:model="name" required autofocus />
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Email
                            </label>
                            <div class="mt-2">
                                <x-input icon="at-symbol" id="email" type="email" wire:model="email" required />
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Phone
                                Number
                            </label>
                            <div class="mt-2">
                                <x-input icon="device-mobile" type="number" wire:model="phone_number" />
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-gray-100">Password</label>
                            <div class="mt-2">
                                <x-inputs.password icon="key" type="password" required wire:model="password" />
                            </div>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-100">Confirm
                                Password</label>
                            <div class="mt-2">
                                <x-inputs.password icon="key" type="password" required
                                    wire:model="confirm_password" />
                            </div>
                        </div>



                        <div>
                            <button>
                                <x-button wire:click="verifyNumber" rounded label="Create Account" md
                                    class="w-full font-bold" negative right-icon="arrow-right" />
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
    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                aria-hidden="true"></div>

            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div>
                    <div class="mx-auto flex w-full max-w-md flex-col space-y-16">
                        <div class="flex flex-col items-center justify-center text-center space-y-2">
                            <div class="font-semibold text-3xl">
                                <p>Enter Verification Code</p>
                            </div>
                            <div class="flex flex-row text-sm font-medium text-gray-400">
                                <p>We have sent a code to your phone number ({{ $phone_number }})</p>
                            </div>
                        </div>

                        <div>
                            <form action="" method="post">
                                <div class="flex flex-col space-y-16">
                                    <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs">
                                        <div class="w-16 h-16 ">
                                            <input
                                                class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                                type="text" name="" id="" wire:model="one">
                                        </div>
                                        <div class="w-16 h-16 ">
                                            <input
                                                class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                                type="text" name="" id="" wire:model="two">
                                        </div>
                                        <div class="w-16 h-16 ">
                                            <input
                                                class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                                type="text" name="" id="" wire:model="three">
                                        </div>
                                        <div class="w-16 h-16 ">
                                            <input
                                                class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                                type="text" name="" id="" wire:model="four">
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-5">
                                        <div>
                                            {{-- <button
                                                class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-5 bg-red-700 border-none text-white shadow-sm">
                                                Verify Account
                                            </button> --}}
                                            <x-button wire:click="verifyAccount" spinner="verifyAccount"
                                                label="Verify Account" lg class="font-bold w-full" negative rounded />
                                        </div>

                                        <div
                                            class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500">
                                            <p>Didn't recieve code?</p> <a
                                                class="flex flex-row items-center text-blue-600" href="http://"
                                                target="_blank" rel="noopener noreferrer">Resend</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
