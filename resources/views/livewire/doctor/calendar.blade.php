<div>
    <div class="py-2">

        <div class="p-5 bg-white bg-opacity-50 rounded-xl">
            <div id='calendar'></div>
        </div>
    </div>


    <div class="modal" id="myModal">
        <div class="modal-content">
            <div class="flex justify-between items-center">
                <h2 class="text-center" id="modalTitle"></h2>
                <span class="close">&times;</span>

            </div>
            <p id="modalBody"></p>

        </div>
    </div>

    @push('scripts')
        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
                transition: opacity 0.5s;
            }

            .modal.fade {
                opacity: 0;
                pointer-events: none;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 20%;
                border-radius: 8px;
                line-height: 1.5;
            }

            .modal-content p {
                margin-bottom: 5px;
                margin-top: 5px;
            }

            .fc-event {
                cursor: pointer;
                text-align: center;
            }

            #calendar .fc-button {
                background-color: #0a5200;
                border-color: #0a5200;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
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
                        start: false,
                        center: 'title',
                        end: 'prev next',
                    },
                    displayEventTime: false,
                    eventColor: '#E12129',
                    events: {!! json_encode($events) !!},
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
                        const formattedDateTo = info.event.start.toLocaleString('en-US', options);
                        modalTitle.innerHTML = 'APPOINTMENTS DETAILS';
                        modalBody.innerHTML =
                            '<div class="bg-primary-100 mt-3 p-3 rounded-md"><li class="flex py-1"><div class="ml-3"><p class="font-bold uppercase text-gray-700">' +
                            info.event.extendedProps.name +
                            '</p><p class="text-xs text-gray-500">' + info.event.extendedProps.other +
                            '</p>' + '</p><p class="text-xs text-gray-500">' + info.event.extendedProps
                            .description +
                            '</p><p class="text-xs text-gray-500">' + '</div></li> </div>';
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
    @endpush
