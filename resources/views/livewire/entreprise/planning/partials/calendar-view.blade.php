<div class="card">
    <!-- Calendar Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <button wire:click="previousMonth" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h2 class="text-xl font-bold text-white">
                {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('fr')->isoFormat('MMMM YYYY') }}
            </h2>
            <button wire:click="nextMonth" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        <button wire:click="goToToday" class="btn btn-secondary btn-sm">
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

        <div class="calendar-grid">
            @foreach($calendarData as $dayData)
                <div class="calendar-day {{ !$dayData['isCurrentMonth'] ? 'other-month' : '' }} {{ $dayData['isToday'] ?? false ? 'today' : '' }}">
                    <span class="day-number">{{ $dayData['day'] }}</span>

                    @if($dayData['isCurrentMonth'] && count($dayData['events']) > 0)
                        @foreach($dayData['events']->take(3) as $event)
                            <div class="calendar-event {{ $this->getStatusClass($event->status) }}"
                                 wire:click="openDetailsModal({{ $event->id }})"
                                 style="cursor: pointer;">
                                <div class="event-time">
                                    {{ \Carbon\Carbon::parse($event->date_entretient)->format('H:i') }}
                                </div>
                                <div class="event-title">
                                    {{ $event->type_entretient }} - {{ $event->vehicule->matricule }}
                                </div>
                            </div>
                        @endforeach

                        @if(count($dayData['events']) > 3)
                            <div class="text-xs text-slate-400 mt-1 pl-2">
                                +{{ count($dayData['events']) - 3 }} autre(s)
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Legend -->
    <div class="flex flex-wrap items-center gap-4 mt-6 pt-6 border-t border-slate-700/50">
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 rounded-full bg-orange-500"></div>
            <span class="text-sm text-slate-400">En attente</span>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <span class="text-sm text-slate-400">En cours</span>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 rounded-full bg-green-500"></div>
            <span class="text-sm text-slate-400">Terminé</span>
        </div>
    </div>
</div>
