<div class="ml-4">
    <div class="flex space-x-3 items-center">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="h-8 w-8 rounded-full" alt="">
        <div>
            <h1 class="uppercase font-bold text-gray-700">{{ $getRecord()->firstname . ' ' . $getRecord()->lastname }}</h1>
            <h1 class="text-sm leading-3">{{ $getRecord()->specialization }}</h1>
        </div>
    </div>
</div>
