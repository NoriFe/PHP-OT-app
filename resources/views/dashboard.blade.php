<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Add Overtime Button -->
                <button onclick="document.getElementById('addOvertimeForm').style.display='block'">Add Overtime</button>

                <!-- Add Overtime Form -->
                <form id="addOvertimeForm" style="display: none;" method="POST" action="/add-overtime">
                    @csrf
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date">
                        <select id="localization" name="localization">
                            <option value="Production">Production</option>
                            <option value="Distribution">Distribution</option>
                        </select>                        
                        <select id="daytime" name="daytime">
                            <option value="Dayshift">Dayshift</option>
                            <option value="Nightshift">Nightshift</option>
                        </select>
                        <button type="submit" >Add Overtime</button>
                </form>
            </div>
            <div id='calendar'></div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/path/to/your/script.js" data-overtimes="{{ json_encode($overtimes) }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var overtimes = JSON.parse(document.querySelector('script[data-overtimes]').dataset.overtimes);

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: overtimes,
    });
    calendar.render();

    // AJAX form submission
    $('#addOvertimeForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/add-overtime',
            data: $(this).serialize(),
            success: function(response) {
                // Add the new event to the calendar
                var event = {
                    title: 'Overtime - ' + response.where + ' - ' + response.daytime,
                    start: response.date,
                    allDay: true
                };
                calendar.addEvent(event);

                // Hide the form
                $('#addOvertimeForm').hide();
            }
        });
    });
});
</script>
@endpush