<div>
    <header class="px-10 text-xl font-bold text-gray-600">NOTIFICATION</header>
    <div class="py-5 px-10">
        {{-- <div class="flex space-x-2 justify-end items-center">
            <x-button flat right-icon="bookmark-alt" dark label="Mark all as read" />
        </div> --}}
        <div class="flex flex-col space-y-2 mt-3">
            @forelse ($notifications as $notification)
                <div class="bg-white shadow flex  items-center p-5 rounded-lg">
                    <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        aria-hidden="true">
                        <path d="M19 8a3 3 0 100-6 3 3 0 000 6z" fill="#E6291C"></path>
                        <path
                            d="M19 9.5c-2.48 0-4.5-2.02-4.5-4.5 0-.72.19-1.39.49-2H7.52C4.07 3 2 5.06 2 8.52v7.95C2 19.94 4.07 22 7.52 22h7.95c3.46 0 5.52-2.06 5.52-5.52V9.01c-.6.3-1.27.49-1.99.49z"
                            opacity=".4"></path>
                        <path
                            d="M11.75 14h-5c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h5c.41 0 .75.34.75.75s-.34.75-.75.75zM15.75 18h-9c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h9c.41 0 .75.34.75.75s-.34.75-.75.75z">
                        </path>
                    </svg>
                    <div class=" flex-1 px-6">
                        <p>{{ $notification->description }}</p>
                    </div>
                    <div class="  px-6">
                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                    </div>

                </div>
            @empty
                <div class="">
                    <p class="text-center text-xl text-gray-400">No notification</p>
                </div>
            @endforelse

        </div>
    </div>
</div>
