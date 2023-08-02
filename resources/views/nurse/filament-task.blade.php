<div class=" p-5 relative rounded-xl ">
    <div class="flex space-x-3 items-center">
        <img src="{{ asset('images/doctor.png') }}" class="h-12 w-12 bg-red-500 rounded-full" alt="">
        <div class="flex-1">
            <div class="flex justify-between  space-x-3">
                <h1 class="uppercase font-bold text-gray-700">{{ $getRecord()->user->name }}</h1>
            </div>
            <h1 class="text-sm leading-3 text-gray-500">
                {{ \Carbon\Carbon::parse($getRecord()->appointment_date)->format('F d, Y h:i A ') }}</h1>
        </div>
    </div>
    <div class="mt-2 mb-14">
        <h1 class="text-sm leading-3 text-gray-500">Condition:</h1>
        <p class="text-sm leading-4 mt-1 text-justify text-gray-700">{{ $getRecord()->condition }}</p>
    </div>
    <div class="absolute bottom-2 pt-2 left-5 right-5 border-t mt-5">
        <div class="flex items-center justify-end">
            <x-button label="Fill Out" right-icon="document-text" class="font-semibold px-6" sm outline rounded
                positive />
        </div>
    </div>
</div>
