<div>
    <div class="grid grid-cols-4 gap-10">
        <div class="col-span-2">
            <div class="bg-gradient-to-tl from-[#A17666] to-[#617E5B] flex space-x-5 rounded-2xl p-5">
                <div class="flex items-center text-white justify-center space-x-3  ">
                    <div class="w-full">
                        <h1 class="font-bold">VISITS FOR TODAY</h1>
                        <h1 class="mt-3 text-3xl font-bold">
                            {{ $visits }}
                        </h1>
                        <div class="mt-3 w-full">
                            <div class="flex space-x-4  w-full">
                                <div class="border p-5  rounded-xl">
                                    <center>
                                        <h1 class="text-sm">New Patients</h1>
                                        <h1 class="text-lg">{{ $new }}</h1>
                                    </center>
                                </div>
                                <div class="border p-5  rounded-xl">
                                    <center>
                                        <h1 class="text-sm">Old Patients</h1>
                                        <h1 class="text-lg">{{ $old }}</h1>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid place-content-center text-white flex-1">
                    <center>
                        <img src="{{ asset('images/logo.png') }}" class="h-20" alt="">
                        <h1 class="mt-2 font-bold">SMMG-BULAN</h1>
                    </center>
                </div>
            </div>

            <div class="mt-5">
                <div class="  rounded-full bg-white bg-opacity-60 ">
                    <div class="flex space-x-3 ">
                        <div class="h-20 w-20 bg-[#617E5B] grid place-content-center rounded-full shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8 w-8  fill-white">
                                <path
                                    d="M17 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9V3H15V1H17V3ZM4 9V19H20V9H4ZM6 11H8V13H6V11ZM6 15H8V17H6V15ZM10 11H18V13H10V11ZM10 15H15V17H10V15Z">
                                </path>
                            </svg>
                        </div>
                        <div class=" mt-3">
                            <h1 class="text-xl font-bold uppercase text-gray-700">
                                {{ \Carbon\Carbon::parse(now())->format('F d, Y') }}</h1>
                            <h1 class="text-xl font-bold uppercase text-green-700">
                                {{ \Carbon\Carbon::parse(now())->isoformat('dddd') }}</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-span-2">
            {{-- <div class="bg-white rounded-2xl p-5">
                <header class="flex justify-between items-center">
                    <span class="text-xl font-bold text-gray-600">PATIENT LIST</span>
                </header>
                <div class="mt-3">
                    <ul class="flex flex-col space-y-3">
                        @forelse ($patients as $patient)
                            <li class="border-b py-2 flex justify-between items-center">
                                <div class="flex space-x-3 items-center">
                                    <img src="{{ asset('images/doctor.png') }}"
                                        class="h-12 rounded-full bg-red-500 w-12" alt="">
                                    <div>
                                        <h1 class="text-lg text-gray-700 font-bold uppercase">{{ $patient->name }}</h1>
                                        <h1 class="text-sm leading-3">{{ $patient->email }}</h1>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </li>
                        @empty
                            <div>
                                No data available...
                            </div>
                        @endforelse

                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="mt-10">
        {{ $this->table }}
    </div>
</div>
