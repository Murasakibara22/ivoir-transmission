<div class="card hover:shadow-xl transition-all cursor-pointer"
     wire:click="openDetailsModal({{ $historique->id }})">
    <div class="flex items-start gap-4">
        <!-- Date Badge -->
        <div class="flex-shrink-0">
            @php
                $date = \Carbon\Carbon::parse($historique->date_entretient);
                $statusColors = [
                    'PENDING' => ['bg' => 'bg-orange-500/10', 'border' => 'border-orange-500/20', 'text' => 'text-orange-400'],
                    'IN_PROGRESS' => ['bg' => 'bg-red-500/10', 'border' => 'border-red-500/20', 'text' => 'text-red-400'],
                    'DONE' => ['bg' => 'bg-green-500/10', 'border' => 'border-green-500/20', 'text' => 'text-green-400'],
                    'CANCELLED' => ['bg' => 'bg-slate-500/10', 'border' => 'border-slate-500/20', 'text' => 'text-slate-400'],
                ];
                $colors = $statusColors[$historique->status] ?? $statusColors['PENDING'];
            @endphp
            <div class="w-16 h-16 {{ $colors['bg'] }} border-2 {{ $colors['border'] }} rounded-xl flex flex-col items-center justify-center">
                <span class="text-2xl font-bold {{ $colors['text'] }}">{{ $date->format('d') }}</span>
                <span class="text-xs {{ $colors['text'] }}">{{ $date->locale('fr')->isoFormat('MMM') }}</span>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4 mb-3">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="status-badge {{ $this->getStatusBadge($historique->status) }}">
                            {{ $this->getStatusLabel($historique->status) }}
                        </span>
                        <span class="text-sm text-slate-500">{{ $date->format('H:i') }}</span>

                        <!-- Badge si c'est aujourd'hui -->
                        @if($date->isToday())
                            <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20 animate-pulse">
                                Aujourd'hui
                            </span>
                        @endif

                        <!-- Badge si en retard -->
                        @if($date->isPast() && $historique->status === 'PENDING')
                            <span class="status-badge status-urgent animate-pulse">
                                En retard
                            </span>
                        @endif
                    </div>

                    <h3 class="text-lg font-semibold text-white mb-1">{{ $historique->type_entretient }}</h3>

                    <p class="text-slate-400 text-sm mb-2">
                        {{ $historique->vehicule->libelle }} - {{ $historique->vehicule->matricule }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                        @if($historique->contrat)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ $historique->contrat->libelle }}
                        </span>
                        @endif

                        @if($historique->entretien)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                            Entretien #{{ $historique->entretien->numero_entretien }}
                        </span>
                        @endif

                        @if($historique->kilometrage_intervention)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ number_format($historique->kilometrage_intervention) }} km
                        </span>
                        @endif

                        <!-- Délai relatif -->
                        <span class="flex items-center gap-1 {{ $date->isPast() ? 'text-slate-500' : 'text-blue-400' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $date->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <button class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors text-slate-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
