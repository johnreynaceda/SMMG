@section('title', 'CALENDAR')
<x-doctor-layout>
    <div class="bg-white p-5 rounded-xl">
        <livewire:doctor.calendar />
    </div>
    {{-- @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    views: {
                        timeGridWeek: {
                            type: 'timeGrid',
                            duration: {
                                days: 7
                            },
                            buttonText: 'week'
                        }
                    },
                    headerToolbar: {
                        start: 'prev next',
                        center: 'title',
                        end: 'today timeGridWeek dayGridMonth'
                    },
                    displayEventTime: false,
                    eventColor: '#0a5200',
                    events: [],
                    eventClick: function(info) {
                        // Display additional information in a modal-like dialog
                        var modal = document.getElementById('myModal');
                        var modalTitle = document.getElementById('modalTitle');
                        var modalBody = document.getElementById('modalBody');
                        const options = {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric'
                        };
                        const formattedDateFrom = info.event.start.toLocaleString('en-US', options);
                        const formattedDateTo = info.event.end.toLocaleString('en-US', options);
                        modalTitle.innerHTML = 'APPOINTMENTS DETAILS';
                        modalBody.innerHTML =
                            '<div class="bg-primary-100 mt-3 p-3 rounded-md"><li class="flex py-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" class="fill-green-700" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zM4 9v10h16V9H4zm2 2h2v2H6v-2zm0 4h2v2H6v-2zm4-4h8v2h-8v-2zm0 4h5v2h-5v-2z"/></svg><div class="ml-3"><p class="font-bold uppercase text-gray-700">' +
                            info.event.extendedProps.name +
                            '</p><p class="text-xs text-gray-500">' + info.event.extendedProps.description +
                            '</p><p class="text-xs text-gray-500">' + info.event.extendedProps.other +
                            '</p></div></li> <div class="mt-2"><button id="delete" type="button" class="rounded flex space-x-1 items-center bg-red-600 py-1 px-2 text-xs text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="myFunction()"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg><span>Delete Event</span></button></div></div>';
                        modal.style.display = 'block';
                        var closeButton = document.getElementsByClassName('close')[0];
                        closeButton.onclick = function() {
                            modal.style.display = 'none';
                        }

                        var deleteButton = document.getElementById('delete');

                        deleteButton.onclick = function() {
                            modal.style.display = 'none';
                            Livewire.emit('deleteEvent', info.event.extendedProps.event_id);
                        }



                        document.addEventListener('keydown', function(event) {
                            if (event.key === 'Escape') {
                                modal.style.display = 'none';
                            }


                        });



                    }

                });
                calendar.render();



            });
        </script>
    @endpush --}}
</x-doctor-layout>
