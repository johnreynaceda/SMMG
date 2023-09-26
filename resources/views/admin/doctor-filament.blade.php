<div class="ml-4">
    <div class="flex space-x-3 items-center">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="h-8 w-8 rounded-full" alt="">
        <div>
            <h1 class="uppercase font-bold text-gray-700">{{ $getRecord()->user->name }}</h1>
            <h1 class="text-sm leading-3">
                @if (request()->routeIs('admin.nurses') == true)
                    <span>{{ $getRecord()->specialization }}</span>
                @else
                    <span>{{ $getRecord()->specialization->name ?? '' }}</span>
                @endif

            </h1>
        </div>
    </div>
</div>
