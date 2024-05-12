   <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           var calendarEl = document.getElementById('calendar');
           var calendar = new FullCalendar.Calendar(calendarEl, {
               initialView: 'timeGridWeek',
               headerToolbar: {
                   left: 'prev,next today',
                   center: 'title',
                   right: 'timeGridWeek,timeGridDay'
               },
               //TODO dynamic events
               events: [{
                       title: 'Novák Jan',
                       start: '2024-05-10T12:00:00'
                   },
                   {
                       title: 'Novák Jan',
                       start: '2024-05-10T10:00:00'
                   }, {

                       title: 'Novák Jan',
                       start: '2024-05-10T10:00:00'
                   }
               ],
               eventBackgroundColor: '#b9cfbf',
               eventTextColor: '#676767',
               eventBorderColor: '#9EABA2',
               firstDay: 1,
               weekends: false,
               slotDuration: '00:30:00',
               slotMinTime: '09:00:00',
               slotMaxTime: '16:00:00',
               height: '80vh',
               expandRows: true,
               slotDuration: '01:00:00',
               slotEventOverlap: false,
               allDaySlot: false, //Comment for true
           });
           calendar.render();
       });
   </script>
   <link rel="stylesheet" type="text/css" href="./styles/calendarOverride.css">