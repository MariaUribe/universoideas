<link href='calendar/fullcalendar.min.css' rel='stylesheet' />
<link href='calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='calendar/moment.min.js'></script>
<script src='calendar/fullcalendar.min.js'></script>

<script>
    $(document).ready(function() {
        var events = <?php echo $json_events ?>;
        
        $('#calendar').fullCalendar({
            editable: false,
            events: events,
            eventColor: '#F7941E',
            firstDay: 1,
            buttonText: { today: 'hoy' },
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
        });
    });
</script>

<div class="row">
    <h2 class="page-header">Calendario de Eventos</h2>
    <div class="col-md-8 col-md-offset-2">
        <div id='calendar' class="mt20"></div>
    </div>
</div>
