{{-- resources/views/livewire/entreprise/planning/partials/calendar-view.blade.php --}}
<div class="card">
    <!-- Calendar Header -->
    <div class="flex items-center justify-between p-4 border-b border-slate-700/50">
        <button wire:click="previousMonth" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <div class="flex items-center gap-4">
            <h3 class="text-xl font-bold text-white">
                {{ \Carbon\Carbon::create($currentYear, $currentMonth)->locale('fr')->translatedFormat('F Y') }}
            </h3>
            <button wire:click="goToToday" class="px-3 py-1 text-sm bg-blue-500/10 text-blue-400 rounded-lg hover:bg-blue-500/20 transition-colors">
                Aujourd'hui
            </button>
        </div>

        <button wire:click="nextMonth" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    <!-- Calendar Grid -->
    <div class="p-4">
        <!-- Day headers -->
        <div class="grid grid-cols-7 gap-2 mb-2">
            @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day)
            <div class="text-center text-sm font-semibold text-slate-400 py-2">{{ $day }}</div>
            @endforeach
        </div>

        <!-- Calendar days -->
        <div class="grid grid-cols-7 gap-2">
            @foreach($calendarData as $dayData)
            <div class="calendar-day {{ $dayData['isCurrentMonth'] ? '' : 'other-month' }} {{ $dayData['isToday'] ?? false ? 'today' : '' }} min-h-[100px] p-2 rounded-lg border border-slate-700/30 hover:border-slate-600/50 transition-colors">
                <div class="text-sm font-medium {{ $dayData['isCurrentMonth'] ? 'text-white' : 'text-slate-600' }} mb-1">
                    {{ $dayData['day'] }}
                </div>

                @if( count($dayData['events']) > 0)
                    <div class="space-y-1">
                        @foreach($dayData['events']->take(2) as $entretien)
                        <button wire:click="openDetailsModal({{ $entretien->id }})"
                                class="w-full text-left p-1 rounded text-xs {{ $this->getStatusClass($entretien->status) }} hover:opacity-80 transition-opacity">
                            <div class="font-medium truncate">Entretien #{{ $entretien->numero_entretien }}</div>
                            <div class="text-xs opacity-75">{{ $entretien->nombre_vehicules_total }} véhicule(s)</div>
                        </button>
                        @endforeach

                        @if( count($dayData['events']) > 2)
                        <div class="text-xs text-slate-400 pl-1">
                            +{{  count($dayData['events']) - 2 }} autre(s)
                        </div>
                        @endif
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .calendar-day.today {
        background: rgba(59, 130, 246, 0.1);
        border-color: rgb(59, 130, 246);
    }

    .calendar-day.other-month {
        opacity: 0.4;
    }

    .event-attente {
        background: rgba(245, 158, 11, 0.15);
        color: rgb(251, 191, 36);
        border-left: 3px solid rgb(245, 158, 11);
    }

    .event-urgent {
        background: rgba(239, 68, 68, 0.15);
        color: rgb(248, 113, 113);
        border-left: 3px solid rgb(239, 68, 68);
    }

    .event-confirme {
        background: rgba(34, 197, 94, 0.15);
        color: rgb(74, 222, 128);
        border-left: 3px solid rgb(34, 197, 94);
    }
</style>
