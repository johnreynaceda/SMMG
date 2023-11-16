<div class="ml-4">
    <div class="flex space-x-3 items-center">
        @if ($getRecord()->gender == 'Male')
            <img src="{{ asset('images/male-doctor.jpg') }}" class="h-8 w-8 rounded-full" alt="">
        @else
            <img src="{{ asset('images/female-doctor.jpg') }}" class="h-8 w-8 rounded-full" alt="">
        @endif
        <div>
            <h1 class="uppercase font-bold text-gray-700">{{ $getRecord()->user->name }}</h1>
            <h1 class="text-sm leading-3">
                @if (request()->routeIs('admin.nurses') === true)
                    {{-- <span>{{ $getRecord()->specialization ?? '' }}</span> --}}
                @else
                    <p class="uppercase truncate w-28 text-xs text-red-500">
                        @foreach ($getRecord()->doctor_specializations as $item)
                            {{ $item->specialization->name }}
                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach
                    </p>
                @endif

            </h1>
        </div>
    </div>
</div>
