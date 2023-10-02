<div>
    <div class="mt-10">
        <form class="space-y-6">

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-100">
                    Email or Phone Number</label>
                <div class="mt-2">
                    <x-input icon="user" id="phone_number" type="text" name="identity" :value="old('phone_number')" required
                        autofocus autocomplete="phone_number" />

                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-100">Password</label>
                <div class="mt-2">
                    <x-inputs.password icon="key" id="password" type="password" name="password" required
                        autocomplete="current-password" />
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
                    <a href="#" class="font-semibold text-gray-400 text-main hover:text-gray-100">Forgot
                        password?</a>
                </div>
            </div>

            <div>
                <button>
                    <x-button type="submit" rounded label="Sign In" md class="w-full font-bold" negative
                        right-icon="login" />
                </button>
                <div class="mt-2 text-center">
                    <p class="text-white">Don't have an account? <a href="{{ route('new-account') }}"
                            class="hover:text-green-500"> Sign Up</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
