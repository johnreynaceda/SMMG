<div>
    <div class="grid grid-cols-3 gap-4">
        @forelse ($appointments as $item)
            <div class="bg-white p-5 relative rounded-xl shadow-xl">
                <div class="flex space-x-3 items-center">
                    <img src="{{ asset('images/doctor.png') }}" class="h-12 w-12 bg-red-500 rounded-full" alt="">
                    <div class="flex-1">
                        <div class="flex justify-between  space-x-3">
                            <h1 class="uppercase font-bold text-gray-700">{{ $item->user->name }}</h1>
                            @switch($item->status)
                                @case('pending')
                                    <x-badge label="Pending" warning outline xs />
                                @break

                                @case('accepted')
                                    <x-badge label="Accepted" positive outline xs />
                                @break

                                @case('declined')
                                    <x-badge label="Decline" negative outline xs />
                                @break

                                @default
                            @endswitch
                        </div>
                        <h1 class="text-sm leading-3 text-gray-500">
                            {{ \Carbon\Carbon::parse($item->appointment_date)->format('F d, Y h:i A ') }}</h1>
                    </div>
                </div>
                <div class="mt-2 mb-14">
                    <h1 class="text-sm leading-3 text-gray-500">Condition:</h1>
                    <p class="text-sm leading-4 mt-1 text-justify text-gray-700">{{ $item->condition }}</p>
                </div>
                <div class="absolute bottom-2 pt-2 left-5 right-5 border-t mt-5">
                    <div class="flex justify-end space-x-2 items-center">
                        @if ($item->status == 'pending')
                            <x-button label="Declined" icon="x-circle" xs rounded outline negative />
                            <x-button label="Accepted" icon="check-circle" xs rounded positive />
                        @else
                            <x-button label="View Check-Up Form" icon="eye" xs rounded positive />
                        @endif
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
