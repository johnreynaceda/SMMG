<div x-data>
    {{ $this->form }}
    @if ($report)
        <div class="py-5 flex justify-end">
            <x-button label="Print Report" @click="printOut($refs.printContainer.outerHTML);" dark right-icon="printer" />
        </div>
    @endif
    <div class="mt-5">
        @switch($report)
            @case(1)
                <div x-ref="printContainer" class="bg-white p-5 rounded-xl" x-animate>
                    <div class="flex space-x-3 items-center">
                        <div>
                            <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-700">MMG - BULAN</h1>
                            <h1 class="text-xl font-bold text-gray-700">List of All Patients</h1>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table id="example" class="table-auto" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">EMAIL</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PHONE NUMBER</th>


                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($reports as $report)
                                    <tr>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->name }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->email }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->phone_number }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @break

            @case(2)
                <div x-ref="printContainer" class="bg-white p-5 rounded-xl" x-animate>
                    <div class="flex space-x-3 items-center">
                        <div>
                            <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-700">MMG - BULAN</h1>
                            <h1 class="text-xl font-bold text-gray-700">List of All Doctors</h1>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table id="example" class="table-auto" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">EMAIL</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PHONE NUMBER</th>


                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($reports as $report)
                                    <tr>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->name }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->email }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->phone_number }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @break

            @case(3)
                <div x-ref="printContainer" class="bg-white p-5 rounded-xl" x-animate>
                    <div class="flex space-x-3 items-center">
                        <div>
                            <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-700">MMG - BULAN</h1>
                            <h1 class="text-xl font-bold text-gray-700">List of All Nurses</h1>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table id="example" class="table-auto" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">EMAIL</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PHONE NUMBER</th>


                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($reports as $report)
                                    <tr>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->name }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->email }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->phone_number }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @break

            @case(4)
                <div x-ref="printContainer" class="bg-white p-5 rounded-xl" x-animate>
                    <div class="flex space-x-3 items-center">
                        <div>
                            <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-700">MMG - BULAN</h1>
                            <h1 class="text-xl font-bold text-gray-700">List of All Appointments</h1>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table id="example" class="table-auto" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">EMAIL</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PHONE NUMBER</th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">DATE OF
                                        APPOINTMENT</th>


                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($reports as $report)
                                    <tr>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->user->name }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->user->email }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $report->user->phone_number }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ \Carbon\Carbon::parse($report->appointment_date)->format('F d, Y  h:i A') }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @break

            @default
        @endswitch
    </div>
</div>
