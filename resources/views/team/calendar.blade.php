@extends('team.layouts.app')

@section('content')
@include('partials.team.navbar')


<div class="team-main">
    
    <div class="team-content">
        <h1><i class="fas fa-calendar-alt"></i> Kalender Project</h1>
        <div id="calendar"></div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var events = @json($events);
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events
    });
    calendar.render();
});
</script>
<style>
.team-main { margin-left: 280px; }
.team-content { padding: 20px; }
#calendar { background: var(--surface-card); border-radius: 20px; padding: 20px; margin-top: 24px; }
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection