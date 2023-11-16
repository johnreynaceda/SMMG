<div x-data="{ verification: @entangle('verification_modal') }">
    {{ $this->form }}

    <div class="mt-5">
        <x-button label="CREATE ACCOUNT" wire:click="createAccount" spinner="createAccount" right-icon="arrow-right" dark />
    </div>
    <div class="mt-5 text-center">
        <p class="text-gray-700">Already have an account? <a href="{{ route('login') }}" class="hover:text-green-500"> Sign
                In</a></p>
    </div>




    <div x-show="verification" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div x-cloak x-show="verification" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-800 bg-opacity-80"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div x-cloak x-show="verification" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="bg-white p-4 text-center rounded-lg ">
                            <h1 class="text-2xl text-center font-semibold mb-4">Enter your 4-digit PIN code:</h1>
                            <p>We have sent a code to your phone number ({{ $contact }})</p>
                            <div class="flex space-x-2">
                                <div class="flex flex-row  mt-10 items-center justify-between mx-auto w-full max-w-xs"
                                    x-data="{ currentInput: 'one', one: @entangle('one'), two: @entangle('two'), three: @entangle('three'), four: @entangle('four') }">
                                    <div class="w-16 h-16">
                                        <input x-ref="inputOne" x-model="one"
                                            x-on:input="$wire.one = $event.target.value; currentInput = 'two'; $refs.inputTwo.focus()"
                                            class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                            type="text" name="" id="">
                                    </div>
                                    <div class="w-16 h-16">
                                        <input x-ref="inputTwo" x-model="two"
                                            x-on:input="$wire.two = $event.target.value; currentInput = 'three'; $refs.inputThree.focus()"
                                            class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                            type="text" name="" id="">
                                    </div>
                                    <div class="w-16 h-16">
                                        <input x-ref="inputThree" x-model="three"
                                            x-on:input="$wire.three = $event.target.value; currentInput = 'four'; $refs.inputFour.focus()"
                                            class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                            type="text" name="" id="">
                                    </div>
                                    <div class="w-16 h-16">
                                        <input x-ref="inputFour" x-model="four"
                                            x-on:input="$wire.four = $event.target.value; currentInput = 'four'"
                                            class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                            type="text" name="" id="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">

                        <x-button label="Verify PIN Code" negative wire:click="verifyAccount" spinner="verifyAccount"
                            class="font-semibold ml-2 " right-icon="check" sm rounded />
                        <div
                            class="flex
                            flex-row items-center justify-center text-center text-sm font-medium space-x-1
                            text-gray-500">
                            <p>Didn't recieve code?</p>
                            <div wire:click="resendCode" class="flex flex-row items-center text-blue-600" href="http://"
                                target="_blank" rel="noopener noreferrer">Resend
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@push('scripts')
    <script>
        Livewire.on('autofocusInput', (data) => {
            document.getElementById(data.inputName).focus();
        });
    </script>
@endpush
