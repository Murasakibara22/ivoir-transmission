{{-- resources/views/dashboard/planning/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Planning')
@section('breadcrumb', 'Planning')

@section('content')
<div class="space-y-6" data-dashboard-view="planning">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Planning de maintenance
            </h1>
            <p class="text-slate-400 mt-1">
                Gérez tous vos rendez-vous de maintenance
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button class="btn btn-secondary" onclick="exportPlanning()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exporter
            </button>
            <button class="btn btn-primary" onclick="openAddRdvModal()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nouveau RDV
            </button>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card bg-blue-500/10 border-blue-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-blue-400">RDV ce mois</p>
                    <p class="stat-value text-blue-400">12</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-orange-500/10 border-orange-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-orange-400">En attente</p>
                    <p class="stat-value text-orange-400">5</p>
                </div>
                <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-green-500/10 border-green-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-green-400">Confirmés</p>
                    <p class="stat-value text-green-400">7</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-red-500/10 border-red-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-red-400">Urgents</p>
                    <p class="stat-value text-red-400">3</p>
                </div>
                <div class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & View Toggle -->
    <div class="card">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Filters -->
            <div class="flex-1 flex flex-col sm:flex-row gap-3">
                <!-- Filtre Véhicule -->
                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les véhicules</option>
                    <option value="1">Mercedes Sprinter - AB-123-CD</option>
                    <option value="2">BMW X3 - MN-456-OP</option>
                    <option value="3">Audi A4 - QR-789-ST</option>
                </select>

                <!-- Filtre Statut -->
                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="urgent">Urgent</option>
                    <option value="confirme">Confirmé</option>
                    <option value="attente">En attente</option>
                    <option value="termine">Terminé</option>
                </select>

                <!-- Filtre Type -->
                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les types</option>
                    <option value="vidange_moteur">Vidange moteur</option>
                    <option value="vidange_boite">Vidange boîte</option>
                    <option value="revision">Révision complète</option>
                    <option value="controle">Contrôle technique</option>
                </select>
            </div>

            <!-- View Toggle -->
            <div class="flex bg-slate-700/50 rounded-xl p-1">
                <button class="view-toggle active px-4 py-2 rounded-lg transition-colors" data-view="calendar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </button>
                <button class="view-toggle px-4 py-2 rounded-lg transition-colors" data-view="timeline">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Calendar View -->
    <div id="calendar-view" class="card">
        <!-- Calendar Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <button onclick="previousMonth()" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-white" id="current-month-year">Octobre 2025</h2>
                <button onclick="nextMonth()" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <button onclick="goToToday()" class="btn btn-secondary btn-sm">
                Aujourd'hui
            </button>
        </div>

        <!-- Calendar Grid -->
        <div class="calendar-wrapper">
            <!-- Days Header -->
            <div class="calendar-header">
                <div class="calendar-day-name">Lun</div>
                <div class="calendar-day-name">Mar</div>
                <div class="calendar-day-name">Mer</div>
                <div class="calendar-day-name">Jeu</div>
                <div class="calendar-day-name">Ven</div>
                <div class="calendar-day-name">Sam</div>
                <div class="calendar-day-name">Dim</div>
            </div>

            <!-- Calendar Days -->
            <div class="calendar-grid" id="calendar-grid">
                <!-- Days will be generated by JavaScript -->

                <!-- Example Day with Events -->
                <div class="calendar-day other-month">
                    <span class="day-number">30</span>
                </div>

                <!-- Day 1 -->
                <div class="calendar-day">
                    <span class="day-number">1</span>
                </div>

                <!-- Day 5 with event -->
                <div class="calendar-day">
                    <span class="day-number">5</span>
                    <div class="calendar-event event-confirme" onclick="openEventDetails(1)">
                        <div class="event-time">09:00</div>
                        <div class="event-title">Vidange - AB-123-CD</div>
                    </div>
                </div>

                <!-- Day 12 with multiple events -->
                <div class="calendar-day">
                    <span class="day-number">12</span>
                    <div class="calendar-event event-urgent" onclick="openEventDetails(2)">
                        <div class="event-time">10:30</div>
                        <div class="event-title">Urgent - MN-456-OP</div>
                    </div>
                    <div class="calendar-event event-attente" onclick="openEventDetails(3)">
                        <div class="event-time">14:00</div>
                        <div class="event-title">Révision - QR-789-ST</div>
                    </div>
                </div>

                <!-- Day 18 -->
                <div class="calendar-day">
                    <span class="day-number">18</span>
                    <div class="calendar-event event-confirme" onclick="openEventDetails(4)">
                        <div class="event-time">11:00</div>
                        <div class="event-title">Vidange boîte</div>
                    </div>
                </div>

                <!-- Day 25 -->
                <div class="calendar-day">
                    <span class="day-number">25</span>
                    <div class="calendar-event event-attente" onclick="openEventDetails(5)">
                        <div class="event-time">15:30</div>
                        <div class="event-title">Contrôle technique</div>
                    </div>
                </div>

                <!-- Today -->
                <div class="calendar-day today">
                    <span class="day-number">31</span>
                    <div class="calendar-event event-urgent" onclick="openEventDetails(6)">
                        <div class="event-time">08:00</div>
                        <div class="event-title">Urgent - Ford Transit</div>
                    </div>
                </div>

                <!-- Fill rest of days -->
                <div class="calendar-day other-month">
                    <span class="day-number">1</span>
                </div>
                <div class="calendar-day other-month">
                    <span class="day-number">2</span>
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="flex flex-wrap items-center gap-4 mt-6 pt-6 border-t border-slate-700/50">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <span class="text-sm text-slate-400">Urgent</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                <span class="text-sm text-slate-400">En attente</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="text-sm text-slate-400">Confirmé</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                <span class="text-sm text-slate-400">Terminé</span>
            </div>
        </div>
    </div>

    <!-- Timeline View (Hidden by default) -->
    <div id="timeline-view" class="space-y-4 hidden">
        <!-- Timeline Item 1 - Urgent -->
        <div class="card hover:shadow-xl transition-shadow cursor-pointer" onclick="openEventDetails(1)">
            <div class="flex items-start gap-4">
                <!-- Date Badge -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-red-500/10 border-2 border-red-500/20 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-red-400">05</span>
                        <span class="text-xs text-red-400">OCT</span>
                    </div>
                </div>

                <!-- Event Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-urgent">Urgent</span>
                                <span class="text-sm text-slate-500">09:00</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Vidange moteur dépassée</h3>
                            <p class="text-slate-400 text-sm mb-2">Mercedes Sprinter - AB-123-CD</p>
                            <div class="flex items-center gap-4 text-sm text-slate-500">
                                <span>📍 Cocody, Angré</span>
                                <span>💰 40,000 FCFA</span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Item 2 - Confirmé -->
        <div class="card hover:shadow-xl transition-shadow cursor-pointer" onclick="openEventDetails(2)">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-green-500/10 border-2 border-green-500/20 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-green-400">12</span>
                        <span class="text-xs text-green-400">OCT</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-success">Confirmé</span>
                                <span class="text-sm text-slate-500">10:30</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Révision complète</h3>
                            <p class="text-slate-400 text-sm mb-2">BMW X3 - MN-456-OP</p>
                            <div class="flex items-center gap-4 text-sm text-slate-500">
                                <span>📍 Yopougon</span>
                                <span>💰 50,000 FCFA</span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Item 3 - En attente -->
        <div class="card hover:shadow-xl transition-shadow cursor-pointer" onclick="openEventDetails(3)">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-orange-500/10 border-2 border-orange-500/20 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-orange-400">18</span>
                        <span class="text-xs text-orange-400">OCT</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-warning">En attente</span>
                                <span class="text-sm text-slate-500">11:00</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Vidange de boîte</h3>
                            <p class="text-slate-400 text-sm mb-2">Audi A4 - QR-789-ST</p>
                            <div class="flex items-center gap-4 text-sm text-slate-500">
                                <span>📍 Koumassi</span>
                                <span>💰 25,000 FCFA</span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DUPLIQUER LES TIMELINE ITEMS CI-DESSUS POUR AJOUTER PLUS D'ÉVÉNEMENTS -->

    </div>

    <!-- Planification en masse -->
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold text-white">Planification en masse</h3>
                <p class="text-sm text-slate-400">Planifiez plusieurs RDV pour vos véhicules</p>
            </div>
            <button class="btn btn-primary btn-sm" onclick="openMassPlanningModal()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Planifier en masse
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-slate-700/30 rounded-xl">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400">Véhicules sélectionnés</p>
                        <p class="text-xl font-bold text-white">0</p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-slate-700/30 rounded-xl">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400">RDV à planifier</p>
                        <p class="text-xl font-bold text-white">0</p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-slate-700/30 rounded-xl">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400">Coût estimé total</p>
                        <p class="text-xl font-bold text-white">0 FCFA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    // Current date
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    document.addEventListener('DOMContentLoaded', function() {
        // View Toggle functionality
        const viewToggles = document.querySelectorAll('.view-toggle');
        const calendarView = document.getElementById('calendar-view');
        const timelineView = document.getElementById('timeline-view');

        viewToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const view = this.dataset.view;

                // Update active states
                viewToggles.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Toggle views
                if (view === 'calendar') {
                    calendarView.classList.remove('hidden');
                    timelineView.classList.add('hidden');
                } else {
                    calendarView.classList.add('hidden');
                    timelineView.classList.remove('hidden');
                }
            });
        });

        // Initialize calendar
        renderCalendar(currentMonth, currentYear);
    });

    // Calendar functions
    function renderCalendar(month, year) {
        // TODO: Implement dynamic calendar rendering
        updateMonthYearDisplay(month, year);
    }

    function updateMonthYearDisplay(month, year) {
        const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                       'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        document.getElementById('current-month-year').textContent = `${months[month]} ${year}`;
    }

    function previousMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    }
