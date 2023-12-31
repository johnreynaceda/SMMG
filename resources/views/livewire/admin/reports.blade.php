<div x-data>


    <div class="my-4 bg-white p-5 rounded-2xl flex justify-between items-center">
        <div class="flex items-center justify-center space-x-3">
            {{-- <x-native-select wire:model="active_filter">
                <option>Select An Option</option>
                <option value="1">Per Day</option>
                <option value="2">Per Week</option>
                <option value="3">By Date</option>
            </x-native-select> --}}

            @if ($active_filter == '3')
                <x-datetime-picker placeholder="Date From" without-time wire:model="date_from" />
                <x-datetime-picker placeholder="Date To" without-time wire:model="date_to" />
            @endif


        </div>
        <div class="flex space-x-1 items-center">
            <x-button.circle icon="refresh" loading-delay="short" warning spinner />
            <x-button label="Print Report" icon="printer" @click="printOut($refs.printContainer.outerHTML);" dark />
        </div>
    </div>

    <div class="bg-white rounded-xl p-10">
        <div x-ref="printContainer">
            <div class="flex space-x-3 items-center">
                <div>
                    <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-700">MMG - BULAN</h1>
                    <h1 class="text-md  leading-3 font-bold uppercase text-gray-500">Appointments List</h1>
                </div>
            </div>
            <div class="mt-10">
                <table id="example" class="table-auto" style="width:100%">
                    <thead class="font-normal">
                        <tr>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PATIENT NAME</th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">DOCTOR NAME</th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">SPECIALIZATION
                            </th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">EMAIL</th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PHONE NUMBER</th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">DATE OF
                                APPOINTMENT
                            </th>


                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($reports as $report)
                            <tr>
                                <td class="border-2 uppercase text-gray-700  px-3 py-1">
                                    {{ $report->user->name }}
                                </td>
                                <td class="border-2 uppercase text-gray-700  px-3 py-1">
                                    {{ $report->doctor->user->name }}
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    @foreach ($report->doctor->doctor_specializations as $value)
                                        {{ $value->specialization->name }}
                                        @if (!$loop->last)
                                            /
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    {{ $report->doctor->user->email }}
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    {{ $report->doctor->user->phone_number }}
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    {{ \Carbon\Carbon::parse($report->appointment_date)->format('F d, Y') }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
