{{-- resources/views/dashboard/planning/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')


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
                24 rendez-vous planifiés ce mois-ci
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
                    <p class="stat-value text-blue-400">24</p>
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
                    <p class="stat-value text-orange-400">8</p>
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
                    <p class="stat-value text-green-400">13</p>
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
                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les véhicules</option>
                    <option value="1">Mercedes Sprinter - AB-123-CD</option>
                    <option value="2">BMW X3 - MN-456-OP</option>
                    <option value="3">Audi A4 - QR-789-ST</option>
                    <option value="4">Ford Transit - UV-012-WX</option>
                    <option value="5">Peugeot Expert - IJ-789-KL</option>
                </select>

                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="urgent">Urgent</option>
                    <option value="confirme">Confirmé</option>
                    <option value="attente">En attente</option>
                    <option value="termine">Terminé</option>
                </select>

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
                <button class="view-toggle px-4 py-2 rounded-lg transition-colors" data-view="list">
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
            <div class="calendar-header">
                <div class="calendar-day-name">Lun</div>
                <div class="calendar-day-name">Mar</div>
                <div class="calendar-day-name">Mer</div>
                <div class="calendar-day-name">Jeu</div>
                <div class="calendar-day-name">Ven</div>
                <div class="calendar-day-name">Sam</div>
                <div class="calendar-day-name">Dim</div>
            </div>

            <div class="calendar-grid" id="calendar-grid">
                <!-- Previous month days -->
                <div class="calendar-day other-month"><span class="day-number">30</span></div>

                <!-- Current month days with events -->
                <div class="calendar-day"><span class="day-number">1</span></div>
                <div class="calendar-day"><span class="day-number">2</span></div>
                <div class="calendar-day"><span class="day-number">3</span></div>
                <div class="calendar-day"><span class="day-number">4</span></div>

                <div class="calendar-day">
                    <span class="day-number">5</span>
                    <div class="calendar-event event-confirme" onclick="openEventDetails(1)">
                        <div class="event-time">09:00</div>
                        <div class="event-title">Vidange - AB-123-CD</div>
                    </div>
                </div>

                <div class="calendar-day"><span class="day-number">6</span></div>
                <div class="calendar-day"><span class="day-number">7</span></div>
                <div class="calendar-day"><span class="day-number">8</span></div>
                <div class="calendar-day"><span class="day-number">9</span></div>
                <div class="calendar-day"><span class="day-number">10</span></div>
                <div class="calendar-day"><span class="day-number">11</span></div>

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

                <div class="calendar-day"><span class="day-number">13</span></div>
                <div class="calendar-day"><span class="day-number">14</span></div>
                <div class="calendar-day"><span class="day-number">15</span></div>
                <div class="calendar-day"><span class="day-number">16</span></div>
                <div class="calendar-day"><span class="day-number">17</span></div>

                <div class="calendar-day">
                    <span class="day-number">18</span>
                    <div class="calendar-event event-confirme" onclick="openEventDetails(4)">
                        <div class="event-time">11:00</div>
                        <div class="event-title">Vidange boîte</div>
                    </div>
                </div>

                <div class="calendar-day"><span class="day-number">19</span></div>
                <div class="calendar-day"><span class="day-number">20</span></div>
                <div class="calendar-day"><span class="day-number">21</span></div>
                <div class="calendar-day"><span class="day-number">22</span></div>
                <div class="calendar-day"><span class="day-number">23</span></div>
                <div class="calendar-day"><span class="day-number">24</span></div>

                <div class="calendar-day">
                    <span class="day-number">25</span>
                    <div class="calendar-event event-attente" onclick="openEventDetails(5)">
                        <div class="event-time">15:30</div>
                        <div class="event-title">Contrôle technique</div>
                    </div>
                </div>

                <div class="calendar-day"><span class="day-number">26</span></div>
                <div class="calendar-day"><span class="day-number">27</span></div>
                <div class="calendar-day"><span class="day-number">28</span></div>
                <div class="calendar-day"><span class="day-number">29</span></div>
                <div class="calendar-day"><span class="day-number">30</span></div>

                <div class="calendar-day today">
                    <span class="day-number">31</span>
                    <div class="calendar-event event-urgent" onclick="openEventDetails(6)">
                        <div class="event-time">08:00</div>
                        <div class="event-title">Urgent - Ford Transit</div>
                    </div>
                </div>

                <!-- Next month days -->
                <div class="calendar-day other-month"><span class="day-number">1</span></div>
                <div class="calendar-day other-month"><span class="day-number">2</span></div>
                <div class="calendar-day other-month"><span class="day-number">3</span></div>
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

    <!-- List View (Hidden by default) -->
    <div id="list-view" class="space-y-4 hidden">

        <!-- RDV Card 1 - Urgent -->
        <div class="card hover:shadow-xl transition-all cursor-pointer" onclick="openEventDetails(1)">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-red-500/10 border-2 border-red-500/20 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-red-400">05</span>
                        <span class="text-xs text-red-400">OCT</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-urgent">Urgent</span>
                                <span class="text-sm text-slate-500">09:00</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Vidange moteur dépassée</h3>
                            <p class="text-slate-400 text-sm mb-2">Mercedes Sprinter - AB-123-CD</p>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    Cocody, Angré
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    40,000 FCFA
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation(); editRdv(1)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RDV Card 2 - Confirmé -->
        <div class="card hover:shadow-xl transition-all cursor-pointer" onclick="openEventDetails(2)">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-green-500/10 border-2 border-green-500/20 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-green-400">12</span>
                        <span class="text-xs text-green-400">OCT</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-success">Confirmé</span>
                                <span class="text-sm text-slate-500">10:30</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Révision complète</h3>
                            <p class="text-slate-400 text-sm mb-2">BMW X3 - MN-456-OP</p>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    Yopougon
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    50,000 FCFA
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation(); editRdv(2)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RDV Card 3 - En attente -->
        <div class="card hover:shadow-xl transition-all cursor-pointer" onclick="openEventDetails(3)">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-orange-500/10 border-2 border-orange-500/20 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-orange-400">18</span>
                        <span class="text-xs text-orange-400">OCT</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-warning">En attente</span>
                                <span class="text-sm text-slate-500">11:00</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Vidange de boîte</h3>
                            <p class="text-slate-400 text-sm mb-2">Audi A4 - QR-789-ST</p>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    Koumassi
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    25,000 FCFA
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation(); editRdv(3)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dupliquer les cards ci-dessus pour ajouter plus de RDV -->

    </div>


    <!-- Pagination -->
    <div class="card">
        <div class="flex items-center justify-between p-6">
            <div class="flex items-center space-x-2">
                <p class="text-slate-400 text-sm">Affichage de</p>
                <select class="px-2 py-1 bg-slate-700/50 border border-slate-600/50 rounded text-white text-sm">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                <p class="text-slate-400 text-sm">RDV sur 24</p>
            </div>

            <div class="flex items-center space-x-2">
                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div class="flex items-center space-x-1">
                    <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">1</button>
                    <button class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg text-sm transition-colors">2</button>
                    <button class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg text-sm transition-colors">3</button>
                </div>

                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    document.addEventListener('DOMContentLoaded', function() {
        // View Toggle
        const viewToggles = document.querySelectorAll('.view-toggle');
        const calendarView = document.getElementById('calendar-view');
        const listView = document.getElementById('list-view');

        viewToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const view = this.dataset.view;
                viewToggles.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                if (view === 'calendar') {
                    calendarView.classList.remove('hidden');
                    listView.classList.add('hidden');
                } else {
                    calendarView.classList.add('hidden');
                    listView.classList.remove('hidden');
                }
            });
        });

        renderCalendar(currentMonth, currentYear);
    });

    function renderCalendar(month, year) {
        updateMonthYearDisplay(month, year);
        // TODO: Dynamic calendar rendering with real data
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

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    }

    function goToToday() {
        const today = new Date();
        currentMonth = today.getMonth();
        currentYear = today.getFullYear();
        renderCalendar(currentMonth, currentYear);
    }

    function openEventDetails(eventId) {
        const backdrop = document.createElement('div');
        backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Détails du RDV</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <span class="status-badge status-urgent">Urgent</span>
                            <span class="text-slate-400">5 Octobre 2025 à 09:00</span>
                        </div>

                        <div class="p-4 bg-slate-700/30 rounded-xl">
                            <h3 class="text-white font-semibold mb-3">Véhicule concerné</h3>
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-slate-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-semibold">Mercedes Sprinter</p>
                                    <p class="text-slate-400 text-sm">AB-123-CD • 52,000 km</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-white font-semibold mb-3">Type d'intervention</h3>
                            <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                                <p class="text-red-400 font-medium">Vidange moteur dépassée</p>
                                <p class="text-slate-400 text-sm mt-1">Retard: 2,000 km</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-white font-semibold mb-3">Lieu</h3>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="text-white">Cocody, Angré</p>
                                    <p class="text-slate-400 text-sm">C282+FC, Abidjan</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-white font-semibold mb-3">Coût estimé</h3>
                            <p class="text-2xl font-bold text-blue-400">40,000 FCFA</p>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button class="btn btn-primary flex-1" onclick="confirmRdv(${eventId})">
                                Confirmer le RDV
                            </button>
                            <button class="btn btn-secondary" onclick="this.closest('.fixed').remove(); editRdv(${eventId})">
                                Modifier
                            </button>
                            <button class="btn btn-secondary text-red-400" onclick="cancelRdv(${eventId})">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(backdrop);
    }

    function openAddRdvModal() {
        const backdrop = document.createElement('div');
        backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Nouveau rendez-vous</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form class="space-y-4" onsubmit="event.preventDefault(); createRdv()">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Véhicule</label>
                            <select class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner un véhicule</option>
                                <option value="1">Mercedes Sprinter - AB-123-CD</option>
                                <option value="2">BMW X3 - MN-456-OP</option>
                                <option value="3">Audi A4 - QR-789-ST</option>
                                <option value="4">Ford Transit - UV-012-WX</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Type de maintenance</label>
                            <select class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner le type</option>
                                <option value="vidange_moteur">Vidange moteur</option>
                                <option value="vidange_boite">Vidange de boîte</option>
                                <option value="revision">Révision complète</option>
                                <option value="controle">Contrôle technique</option>
                                <option value="diagnostic">Diagnostic électrique</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Date</label>
                                <input type="date" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Heure</label>
                                <input type="time" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Lieu</label>
                            <input type="text" placeholder="Adresse du rendez-vous" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Notes (optionnel)</label>
                            <textarea rows="3" placeholder="Informations complémentaires..." class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="btn btn-primary flex-1">
                                Créer le RDV
                            </button>
                            <button type="button" onclick="this.closest('.fixed').remove()" class="btn btn-secondary">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        document.body.appendChild(backdrop);
    }

    function openMassPlanningModal() {
        const backdrop = document.createElement('div');
        backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Planification en masse</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        <p class="text-slate-400">Sélectionnez plusieurs véhicules et planifiez leurs maintenances en une seule fois</p>

                        <div class="space-y-2">
                            <h3 class="text-white font-semibold mb-3">Sélectionner les véhicules</h3>

                            <label class="flex items-center gap-3 p-4 bg-slate-700/30 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors">
                                <input type="checkbox" class="w-5 h-5 rounded border-slate-600 text-blue-600 focus:ring-blue-500">
                                <div class="flex-1">
                                    <p class="text-white font-medium">Mercedes Sprinter - AB-123-CD</p>
                                    <p class="text-slate-400 text-sm">Dernière vidange: il y a 2 mois</p>
                                </div>
                                <span class="text-blue-400 font-semibold">40,000 FCFA</span>
                            </label>

                            <label class="flex items-center gap-3 p-4 bg-slate-700/30 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors">
                                <input type="checkbox" class="w-5 h-5 rounded border-slate-600 text-blue-600 focus:ring-blue-500">
                                <div class="flex-1">
                                    <p class="text-white font-medium">BMW X3 - MN-456-OP</p>
                                    <p class="text-slate-400 text-sm">Dernière vidange: il y a 3 mois</p>
                                </div>
                                <span class="text-blue-400 font-semibold">50,000 FCFA</span>
                            </label>

                            <label class="flex items-center gap-3 p-4 bg-slate-700/30 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors">
                                <input type="checkbox" class="w-5 h-5 rounded border-slate-600 text-blue-600 focus:ring-blue-500">
                                <div class="flex-1">
                                    <p class="text-white font-medium">Audi A4 - QR-789-ST</p>
                                    <p class="text-slate-400 text-sm">Dernière vidange: il y a 1 mois</p>
                                </div>
                                <span class="text-blue-400 font-semibold">25,000 FCFA</span>
                            </label>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Type de maintenance</label>
                                <select class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="vidange_moteur">Vidange moteur</option>
                                    <option value="vidange_boite">Vidange de boîte</option>
                                    <option value="revision">Révision complète</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Date de début</label>
                                <input type="date" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-slate-400">Véhicules sélectionnés</span>
                                <span class="text-white font-semibold">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Coût total estimé</span>
                                <span class="text-blue-400 font-bold text-xl">0 FCFA</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button class="btn btn-primary flex-1" onclick="createMassPlanning()">
                                Planifier tous les RDV
                            </button>
                            <button onclick="this.closest('.fixed').remove()" class="btn btn-secondary">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(backdrop);
    }

    function exportPlanning() {
        console.log('Exporting planning...');
        // TODO: Implement export
    }

    function confirmRdv(eventId) {
        console.log('Confirming RDV:', eventId);
        // TODO: Implement confirm
    }

    function editRdv(eventId) {
        console.log('Editing RDV:', eventId);
        // TODO: Implement edit
    }

    function cancelRdv(eventId) {
        if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
            console.log('Canceling RDV:', eventId);
            // TODO: Implement cancel
        }
    }

    function createRdv() {
        console.log('Creating RDV...');
        // TODO: Implement create
    }

    function createMassPlanning() {
        console.log('Creating mass planning...');
        // TODO: Implement mass planning
    }
</script>

<style>
    /* Calendar Styles */
    .calendar-wrapper {
        background: rgba(30, 41, 59, 0.3);
        border-radius: 1rem;
        padding: 1.5rem;
    }

    .calendar-header {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .calendar-day-name {
        text-align: center;
        font-weight: 600;
        color: rgb(148, 163, 184);
        font-size: 0.875rem;
        padding: 0.5rem;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
    }

    .calendar-day {
        min-height: 120px;
        background: rgba(51, 65, 85, 0.3);
        border: 1px solid rgba(71, 85, 105, 0.3);
        border-radius: 0.75rem;
        padding: 0.75rem;
        position: relative;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .calendar-day:hover {
        background: rgba(51, 65, 85, 0.5);
        border-color: rgba(59, 130, 246, 0.3);
    }

    .calendar-day.today {
        background: rgba(59, 130, 246, 0.1);
        border: 2px solid rgba(59, 130, 246, 0.5);
    }

    .calendar-day.other-month {
        opacity: 0.3;
    }

    .day-number {
        font-weight: 600;
        color: white;
        font-size: 0.875rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .calendar-event {
        background: rgba(59, 130, 246, 0.2);
        border-left: 3px solid rgb(59, 130, 246);
        padding: 0.5rem;
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .calendar-event:hover {
        background: rgba(59, 130, 246, 0.3);
        transform: translateX(2px);
    }

    .calendar-event:last-child {
        margin-bottom: 0;
    }

    .calendar-event.event-urgent {
        background: rgba(239, 68, 68, 0.2);
        border-left-color: rgb(239, 68, 68);
    }

    .calendar-event.event-urgent:hover {
        background: rgba(239, 68, 68, 0.3);
    }

    .calendar-event.event-attente {
        background: rgba(245, 158, 11, 0.2);
        border-left-color: rgb(245, 158, 11);
    }

    .calendar-event.event-attente:hover {
        background: rgba(245, 158, 11, 0.3);
    }

    .calendar-event.event-confirme {
        background: rgba(34, 197, 94, 0.2);
        border-left-color: rgb(34, 197, 94);
    }

    .calendar-event.event-confirme:hover {
        background: rgba(34, 197, 94, 0.3);
    }

    .event-time {
        font-size: 0.75rem;
        color: rgb(148, 163, 184);
        margin-bottom: 0.25rem;
    }

    .event-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* View Toggle */
    .view-toggle.active {
        background-color: rgba(59, 130, 246, 0.8);
        color: white;
    }

    .view-toggle:not(.active) {
        color: rgb(148, 163, 184);
    }

    .view-toggle:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    /* Stats Cards */
    .stat-card {
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid;
        background-color: rgba(30, 41, 59, 0.5);
    }

    .stat-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .status-urgent {
        background-color: rgba(239, 68, 68, 0.1);
        color: rgb(248, 113, 113);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: rgb(251, 191, 36);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-success {
        background-color: rgba(34, 197, 94, 0.1);
        color: rgb(74, 222, 128);
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    /* Card hover effects */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .calendar-day {
            min-height: 80px;
            padding: 0.5rem;
        }

        .day-number {
            font-size: 0.75rem;
        }

        .calendar-event {
            padding: 0.375rem;
        }

        .event-time,
        .event-title {
            font-size: 0.625rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .calendar-wrapper {
            padding: 1rem;
        }
    }

    @media (max-width: 640px) {
        .calendar-grid {
            gap: 0.25rem;
        }

        .calendar-header {
            gap: 0.25rem;
        }

        .calendar-day-name {
            font-size: 0.75rem;
            padding: 0.25rem;
        }

        .calendar-day {
            min-height: 60px;
            padding: 0.25rem;
        }
    }

    /* Button animations */
    .btn {
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }
</style>
@endpush
