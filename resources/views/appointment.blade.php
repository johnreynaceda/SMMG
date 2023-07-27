<x-app-layout>
    <div class="py-20 ">

        <div class="mx-auto max-w-7xl relative">
            <div class="flex ">
                <x-shared.sidebar />
                <div class="flex-1">
                    <header class="px-10 text-xl font-bold text-gray-600">MY APPOINTMENTS</header>
                    <div class="py-5 px-10">
                        <div class="flex">
                            <x-native-select wire:model="model">
                                <option>Select an Option</option>
                                <option>Upcoming</option>
                                <option>Past</option>
                            </x-native-select>
                        </div>
                        <div class="flex flex-col space-y-2 mt-3">
                            <div class="bg-white shadow flex justify-between items-center p-5 px-10 rounded-lg">
                                <div class="flex space-x-3 items-center">
                                    <div class="h-32 w-32 rounded-full bg-red-500 overflow-hidden">
                                        <img src="{{ asset('images/doctor.png') }}" class="  rounded-lg" alt="">
                                    </div>
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900">JUAN DELA CRUZ</h1>
                                        <h1 class="text-lg text-gray-600">Pediatrician</h1>
                                    </div>
                                </div>
                                <div>
                                    <x-button label="View Details" rounded negative class="px-6 font-bold" />
                                </div>
                            </div>
                            <div class="bg-white shadow flex justify-between items-center p-5 px-10 rounded-lg">
                                <div class="flex space-x-3 items-center">
                                    <div class="h-32 w-32 rounded-full bg-red-500 overflow-hidden">
                                        <img src="{{ asset('images/doctor.png') }}" class="  rounded-lg" alt="">
                                    </div>
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900">JUAN DELA CRUZ</h1>
                                        <h1 class="text-lg text-gray-600">Pediatrician</h1>
                                    </div>
                                </div>
                                <div>
                                    <x-button label="View Details" rounded negative class="px-6 font-bold" />
                                </div>
                            </div>
                            <div class="bg-white shadow flex justify-between items-center p-5 px-10 rounded-lg">
                                <div class="flex space-x-3 items-center">
                                    <div class="h-32 w-32 rounded-full bg-red-500 overflow-hidden">
                                        <img src="{{ asset('images/doctor.png') }}" class="  rounded-lg" alt="">
                                    </div>
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900">JUAN DELA CRUZ</h1>
                                        <h1 class="text-lg text-gray-600">Pediatrician</h1>
                                    </div>
                                </div>
                                <div>
                                    <x-button label="View Details" rounded negative class="px-6 font-bold" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
