<div x-data="{ modelOpen: false }">
    <div
        class="flex flex-1 h-full flex-col relative justify-center bg-gray-700 bg-opacity-80 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 ">
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
                                <x-input icon="user" id="email" type="email" name="email" :value="old('email')"
                                    required autofocus autocomplete="username" />
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Email
                            </label>
                            <div class="mt-2">
                                <x-input icon="user" id="email" type="email" name="email" :value="old('email')"
                                    required autofocus autocomplete="username" />
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Phone
                                Number
                            </label>
                            <div class="mt-2">
                                <x-input icon="user" id="email" type="email" name="email" :value="old('email')"
                                    required autofocus autocomplete="username" />
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
                                <x-button type="submit" @click="modelOpen =!modelOpen" rounded label="Create Account"
                                    md class="w-full font-bold" negative right-icon="arrow-right" />
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
                    <div class="py-6 px-6 w-80 border mx-auto text-center my-6">
                        <form action="#" x-data="otpForm()" method="POST">
                            <div class="flex justify-between">
                                <template x-for="(input, index) in length" :key="index">
                                    <input type="tel" maxlength="1"
                                        class="border border-gray-500 w-10 h-10 text-center" :x-ref="index"
                                        x-on:input="handleInput($event)" x-on:paste="handlePaste($event)"
                                        x-on:keydown.backspace="$event.target.value || handleBackspace($event.target.getAttribute('x-ref'))" />
                                </template>
                            </div>
                            <input type="hidden" name="otp" x-model="value">
                            <button type="submit"
                                class="btn-primary mx-auto block bg-gray-500 w-full p-2 mt-2 text-white">
                                Verify OTP!
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    < script script >
        function otpForm() {
            return {
                length: 6,
                value: "",

                handleInput(e) {
                    const input = e.target;

                    this.value = Array.from(Array(this.length), (element, i) => {
                        return this.$refs[i].value || "";
                    }).join("");

                    if (input.nextElementSibling && input.value) {
                        input.nextElementSibling.focus();
                        input.nextElementSibling.select();
                    }
                },

                handlePaste(e) {
                    const paste = e.clipboardData.getData('text');
                    this.value = paste;

                    const inputs = Array.from(Array(this.length));

                    inputs.forEach((element, i) => {
                        this.$refs[i].value = paste[i] || '';
                    });
                },

                handleBackspace(e) {
                    const previous = parseInt(e, 10) - 1;
                    this.$refs[previous] && this.$refs[previous].focus();
                },
            };
        } <
        />
</script>
