<x-app-layout>
    <div class="py-20 ">

        <div class="mx-auto max-w-7xl relative">
            <div class="flex">
                <x-shared.sidebar />
                <div class="flex-1">
                    <header class="px-10 text-xl font-bold text-gray-600">NOTIFICATION</header>
                    <div class="py-5 px-10">
                        <div class="flex space-x-2 justify-end items-center">
                            <x-button flat right-icon="bookmark-alt" dark label="Mark all as read" />
                        </div>
                        <div class="flex flex-col space-y-2 mt-3">
                            <div class="bg-white shadow flex justify-between items-center p-5 rounded-lg">
                                <div class="h-32 w-32 rounded-full bg-blue-500 overflow-hidden">
                                    <img src="{{ asset('images/doctor.png') }}" class="  rounded-lg" alt="">
                                </div>
                                <div>
                                    <p>Your booking for Dr. Cardo Dalisay has been approved. See you there and be on
                                        time!</p>
                                    <div class="mt-2 text-sm">
                                        <span>06/20/2023</span>
                                    </div>
                                </div>
                                <div>
                                    <x-button label="View Details" outline rounded positive class="px-6 font-bold" />
                                </div>
                            </div>
                            <div class="bg-white shadow flex justify-between items-center p-5 rounded-lg">
                                <div class="h-32 w-32 rounded-full bg-blue-500 overflow-hidden">
                                    <img src="{{ asset('images/doctor.png') }}" class="  rounded-lg" alt="">
                                </div>
                                <div>
                                    <p>Your booking for Dr. Cardo Dalisay has been approved. See you there and be on
                                        time!</p>
                                    <div class="mt-2 text-sm">
                                        <span>06/20/2023</span>
                                    </div>
                                </div>
                                <div>
                                    <x-button label="View Details" outline rounded positive class="px-6 font-bold" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
