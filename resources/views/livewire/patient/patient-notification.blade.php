<div>
    <header class="px-10 text-xl font-bold text-gray-600">NOTIFICATION</header>
    <div class="py-5 px-10">
        <div class="flex space-x-2 justify-end items-center">
            <x-button flat right-icon="bookmark-alt" dark label="Mark all as read" />
        </div>
        <div class="flex flex-col space-y-2 mt-3">
            @forelse ($notifications as $notification)
                <div class="bg-white shadow flex  items-center p-5 rounded-lg">
                    <div class="h-32 w-32 rounded-full bg-blue-500 overflow-hidden">
                        <img src="{{ asset('images/doctor.png') }}" class="  rounded-lg" alt="">
                    </div>
                    <div class=" flex-1 px-6">
                        <p>{{ $notification->description }}</p>
                    </div>

                </div>
            @empty
            @endforelse

        </div>
    </div>
</div>
