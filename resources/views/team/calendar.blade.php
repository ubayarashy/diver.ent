@extends('team.layouts.app')

@section('content')
@include('partials.team.navbar')

<div class="team-main">
    <div class="team-content">
        <!-- Header -->
        <div class="calendar-header reveal">
            <div class="calendar-header-left">
                <span class="section-tag"><i class="fas fa-calendar-alt"></i> KALENDER PROYEK</span>
                <h2 class="section-title">Jadwal <span class="gradient-text">Brief & Update Status</span></h2>
                <p class="section-desc">Pantau tanggal brief dikirim dan jadwal <strong>update status setiap 2 minggu</strong> untuk setiap proyek.</p>
                <div class="divider"></div>
            </div>
            <div class="calendar-legend">
                <div class="legend-item">
                    <span class="legend-color" style="background: #00D2FF;"></span>
                    <span><i class="fas fa-envelope"></i> Brief Terkirim</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background: #F59E0B;"></span>
                    <span><i class="fas fa-clock"></i> Update Status (Minggu ke-2)</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background: #3B82F6;"></span>
                    <span><i class="fas fa-chart-line"></i> On Progress</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background: #10B981;"></span>
                    <span><i class="fas fa-check-circle"></i> Completed</span>
                </div>
            </div>
        </div>
        
        <!-- Calendar -->
        <div class="calendar-widget reveal">
            <div id="calendar"></div>
        </div>
        
        <!-- Info Card -->
        <div class="info-card reveal">
            <div class="info-icon">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div class="info-content">
                <h4>Update Status Setiap 2 Minggu</h4>
                <p>Setiap proyek wajib diupdate statusnya setiap <strong>2 minggu (14 hari)</strong> setelah brief dikirim. Warna event menunjukkan status terbaru proyek.</p>
            </div>
        </div>
        
        <!-- Status Guide -->
        <div class="status-guide reveal">
            <h4><i class="fas fa-chart-simple"></i> Panduan Status</h4>
            <div class="status-list">
                <div class="status-item">
                    <span class="status-badge pending"></span>
                    <span>Pending</span>
                    <small>- Menunggu dikerjakan</small>
                </div>
                <div class="status-item">
                    <span class="status-badge progress"></span>
                    <span>On Progress</span>
                    <small>- Sedang dikerjakan</small>
                </div>
                <div class="status-item">
                    <span class="status-badge review"></span>
                    <span>Review</span>
                    <small>- Menunggu approval</small>
                </div>
                <div class="status-item">
                    <span class="status-badge completed"></span>
                    <span>Completed</span>
                    <small>- Proyek selesai</small>
                </div>
            </div>
        </div>
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
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: events,
        locale: 'id',
        firstDay: 1,
        buttonText: {
            today: 'Hari Ini',
            month: 'Bulan',
            week: 'Minggu'
        },
        eventDidMount: function(info) {
            var event = info.event;
            var props = event.extendedProps;
            
            // Tooltip berbeda untuk brief dan update status
            if (props.type === 'brief') {
                var tooltip = `📋 BRIEF TERKIRIM\n\n`;
                tooltip += `Proyek: ${event.title.replace('📋 ', '')}\n`;
                tooltip += `Client: ${props.client || '-'}\n`;
                tooltip += `Tanggal: ${event.start.toLocaleDateString('id-ID')}\n`;
                tooltip += `Status: ${props.status || 'Pending'}\n\n`;
                tooltip += `⏰ Update status berikutnya: 2 minggu dari sekarang`;
                info.el.setAttribute('data-tooltip', tooltip);
                info.el.style.borderLeft = `3px solid #00D2FF`;
            } 
            else if (props.type === 'update_status') {
                var statusText = {
                    'pending': 'Menunggu',
                    'in_progress': 'On Progress',
                    'review': 'Review',
                    'completed': 'Selesai'
                }[props.status] || props.status;
                
                var tooltip = `🔄 UPDATE STATUS (Minggu ke-2)\n\n`;
                tooltip += `Proyek: ${event.title.replace('🔄 Update Status: ', '')}\n`;
                tooltip += `Client: ${props.client || '-'}\n`;
                tooltip += `Tanggal Update: ${event.start.toLocaleDateString('id-ID')}\n`;
                tooltip += `Status Saat Ini: ${statusText}\n`;
                if (props.brief_date) {
                    tooltip += `Brief dikirim: ${new Date(props.brief_date).toLocaleDateString('id-ID')}\n\n`;
                }
                tooltip += `💡 Update status proyek secara berkala setiap 2 minggu`;
                info.el.setAttribute('data-tooltip', tooltip);
            }
            
            // Efek hover
            info.el.style.transition = 'all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1)';
            info.el.style.cursor = 'pointer';
        },
        eventClick: function(info) {
            var event = info.event;
            var props = event.extendedProps;
            
            if (props.type === 'brief') {
                var message = `╔══════════════════════════════╗\n`;
                message += `║   📋 BRIEF PROYEK TERKIRIM    ║\n`;
                message += `╚══════════════════════════════╝\n\n`;
                message += `📌 Proyek: ${event.title.replace('📋 ', '')}\n`;
                message += `👥 Client: ${props.client || '-'}\n`;
                message += `📅 Tanggal Brief: ${event.start.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}\n`;
                message += `📊 Status: ${props.status || 'Pending'}\n\n`;
                message += `⏰ Jadwal Update Status: ${new Date(event.start.getTime() + 14 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}\n\n`;
                message += `📝 Brief berisi arahan dan requirement proyek.\n`;
                message += `💡 Update status setiap 2 minggu sekali.`;
                alert(message);
            } 
            else if (props.type === 'update_status') {
                var statusText = {
                    'pending': '⏳ Menunggu',
                    'in_progress': '⚡ On Progress',
                    'review': '👁️ Review',
                    'completed': '✅ Selesai'
                }[props.status] || props.status;
                
                var message = `╔══════════════════════════════╗\n`;
                message += `║  🔄 UPDATE STATUS MINGGU KE-2 ║\n`;
                message += `╚══════════════════════════════╝\n\n`;
                message += `📌 Proyek: ${event.title.replace('🔄 Update Status: ', '')}\n`;
                message += `👥 Client: ${props.client || '-'}\n`;
                message += `📅 Tanggal Update: ${event.start.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}\n`;
                message += `📊 Status Saat Ini: ${statusText}\n`;
                if (props.brief_date) {
                    message += `📋 Brief Dikirim: ${new Date(props.brief_date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}\n\n`;
                }
                message += `⚠️ Wajib update status proyek setiap 2 minggu!\n`;
                message += `💡 Klik untuk update status proyek.`;
                alert(message);
            }
            
            // Buka detail task jika ada URL
            if (event.url) {
                if (confirm('Buka detail proyek?')) {
                    window.open(event.url, '_blank');
                }
            }
        },
        dayMaxEvents: true,
        nowIndicator: true,
        height: 'auto',
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: '09:00',
            endTime: '17:00',
        }
    });
    
    calendar.render();
});
</script>

<style>
/* Calendar Styles - diver.ent Theme */

.team-main { 
    margin-left: 280px; 
    background: var(--bg);
    min-height: 100vh;
}

.team-content { 
    padding: 40px 48px;
}

/* Header */
.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 30px;
    margin-bottom: 40px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 32px 40px;
    transition: var(--transition);
}

.calendar-header-left {
    flex: 1;
}

.calendar-header-left .section-tag {
    margin-bottom: 16px;
}

.calendar-header-left .section-title {
    margin-bottom: 16px;
    font-size: clamp(1.8rem, 4vw, 2.5rem);
}

.calendar-header-left .section-desc {
    margin-bottom: 0;
    color: var(--text-secondary);
}

.calendar-header-left .divider {
    margin-top: 24px;
    margin-bottom: 0;
}

/* Legend */
.calendar-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    background: var(--surface-alt);
    padding: 16px 24px;
    border-radius: var(--radius-md);
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--text-secondary);
    padding: 6px 12px;
    background: var(--surface);
    border-radius: 50px;
    transition: var(--transition);
}

.legend-item:hover {
    transform: translateY(-2px);
    color: var(--text);
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 3px;
    display: inline-block;
}

.legend-item i {
    font-size: 0.7rem;
}

/* Calendar Widget */
.calendar-widget {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 32px;
    transition: var(--transition);
    margin-bottom: 30px;
}

.calendar-widget:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--accent);
}

/* Info Card */
.info-card {
    display: flex;
    gap: 20px;
    background: linear-gradient(135deg, var(--surface) 0%, var(--surface-alt) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 32px;
    align-items: center;
    margin-bottom: 30px;
}

.info-icon {
    width: 48px;
    height: 48px;
    background: var(--accent-glow);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--accent);
}

.info-content h4 {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--text);
}

.info-content p {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin: 0;
}

/* Status Guide */
.status-guide {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 32px;
}

.status-guide h4 {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-list {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 180px;
    padding: 10px 0;
}

.status-badge {
    width: 12px;
    height: 12px;
    border-radius: 3px;
}

.status-badge.pending { background: #F59E0B; }
.status-badge.progress { background: #3B82F6; }
.status-badge.review { background: #8B5CF6; }
.status-badge.completed { background: #10B981; }

.status-item span {
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--text);
    min-width: 90px;
}

.status-item small {
    font-size: 0.7rem;
    color: var(--text-muted);
}

/* FullCalendar */
.fc {
    font-family: var(--font-body);
    background: transparent;
}

.fc-toolbar-title {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text);
}

.fc-button-primary {
    background: var(--surface-alt) !important;
    border: 1px solid var(--border) !important;
    color: var(--text) !important;
    font-weight: 600 !important;
    padding: 8px 16px !important;
    border-radius: 50px !important;
    transition: var(--transition) !important;
}

.fc-button-primary:hover {
    background: var(--accent) !important;
    border-color: var(--accent) !important;
    color: #0A192F !important;
    transform: translateY(-2px);
}

.fc-button-active {
    background: var(--accent) !important;
    border-color: var(--accent) !important;
    color: #0A192F !important;
}

.fc-daygrid-day {
    transition: var(--transition);
    border-color: var(--border-light);
}

.fc-daygrid-day:hover {
    background: var(--surface-alt);
}

.fc-daygrid-day-number {
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);
    padding: 8px;
}

.fc-day-today {
    background: var(--surface-alt) !important;
}

.fc-day-today .fc-daygrid-day-number {
    background: var(--accent);
    color: #0A192F;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.fc-day-other .fc-daygrid-day-number {
    color: var(--text-muted);
}

/* Events */
.fc-event {
    border-radius: 8px !important;
    border: none !important;
    padding: 5px 8px !important;
    font-size: 0.7rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: var(--transition) !important;
    margin: 2px 4px !important;
}

.fc-event:hover {
    transform: scale(1.02);
    filter: brightness(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Tooltip */
.fc-event[data-tooltip] {
    position: relative;
}

.fc-event[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #0A192F;
    color: #FBF9FB;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 500;
    white-space: pre-line;
    z-index: 1000;
    pointer-events: none;
    margin-bottom: 8px;
    min-width: 220px;
    text-align: left;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    line-height: 1.5;
}

/* Responsive */
@media (max-width: 1024px) {
    .team-content {
        padding: 30px 24px;
    }
    
    .calendar-header {
        flex-direction: column;
        padding: 24px 28px;
    }
    
    .calendar-legend {
        width: 100%;
    }
    
    .status-list {
        flex-direction: column;
        gap: 12px;
    }
}

@media (max-width: 768px) { 
    .team-main { 
        margin-left: 0; 
    }
    
    .team-content {
        padding: 20px 16px;
    }
    
    .calendar-header {
        padding: 20px;
    }
    
    .calendar-widget {
        padding: 16px;
    }
    
    .info-card {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
    
    .fc-toolbar {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start !important;
    }
    
    .fc-toolbar-title {
        font-size: 1.1rem;
    }
}
</style>
@endsection