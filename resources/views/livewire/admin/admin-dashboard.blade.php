<div>
    <div>
        <div class="grid grid-cols-4 gap-5">
            <div class="border bg-gradient-to-tl from-[#A17666] to-[#617E5B] relative rounded-xl h-96 p-5">
                <img src="{{ asset('images/logo.png') }}" class="absolute bottom-5 opacity-50 right-5 h-14" alt="">
                <h1 class="font-bold text-white">Visits for Today</h1>
                <h1 class="text-gray-100 text-4xl font-bold ">{{ $visits }}</h1>
                <div class="mt-10">
                    <div class="w-full bg-white bg-opacity-70 rounded-lg p-5">
                        <center>
                            <h1 class="font-bold text-gray-600">New Patient</h1>
                            <h1 class="text-xl font-semibold text-gray-600">{{ $new }}</h1>
                        </center>
                    </div>
                    <div class="w-full mt-5 relative bg-white bg-opacity-70 rounded-lg p-5">
                        <center>
                            <h1 class="font-bold text-gray-600">Old Patient</h1>
                            <h1 class="text-xl font-semibold text-gray-600">{{ $old }}</h1>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-span-3">
                <div class="grid grid-cols-2 gap-5">
                    @foreach ($specialists as $item)
                        <div class="bg-white relative overflow-hidden h-[11.4rem] rounded-xl p-5">
                            <div class="absolute -bottom-20 right-20 opacity-5 ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-56 fill-red-700">
                                    <path
                                        d="M5 3V19H21V21H3V3H5ZM19.9393 5.93934L22.0607 8.06066L16 14.1213L13 11.121L9.06066 15.0607L6.93934 12.9393L13 6.87868L16 9.879L19.9393 5.93934Z">
                                    </path>
                                </svg>
                            </div>
                            <h1 class="text-xl font-bold text-gray-700">{{ $item->name }}</h1>
                            <div class="mt-10 flex justify-between items-center">
                                <h1 class="text-2xl font-black text-green-700">
                                    {{-- @php
                                        $count = 0;
                                        $count = \App\Models\PatientAppointment::where('status', 'accepted')
                                            ->whereHas('doctor', function ($query) use ($item) {
                                                $query->whereHas('doctor_specializations', function ($query) use ($item) {
                                                    $query->where('specialization_id', $item->id);
                                                });
                                            })
                                            ->count();
                                    @endphp
                                    {{ $count }} --}}
                                </h1>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="h-7 w-7 fill-green-700">
                                    <path
                                        d="M14.2558 21.7442L12 24L9.74416 21.7442C5.30941 20.7204 2 16.7443 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12C22 16.7443 18.6906 20.7204 14.2558 21.7442ZM6.02332 15.4163C7.49083 17.6069 9.69511 19 12.1597 19C14.6243 19 16.8286 17.6069 18.2961 15.4163C16.6885 13.9172 14.5312 13 12.1597 13C9.78821 13 7.63095 13.9172 6.02332 15.4163ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-10 bg-white rounded-lg p-5">
            <header>
                <h1 class="text-xl font-bold text-gray-600"></h1>
            </header>
            <div class="mt-3">
                <canvas id="barChart" width="400" height="200"></canvas>
                {{-- <script>
                    // Data from your query
                    const count = <?php echo $count; ?>;
                    const specializationName = <?php echo json_encode($item->name); ?>;

                    // Create a bar chart
                    const ctx = document.getElementById('barChart').getContext('2d');
                    const barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [specializationName], // Label for the specialization
                            datasets: [{
                                label: 'Appointment Count',
                                data: [count], // Count of accepted appointments
                                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue color for the bar
                                borderWidth: 1,
                            }],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Appointment Count'
                                    }
                                }
                            }
                        }
                    });
                </script> --}}
            </div>
        </div>
    </div>
</div>
