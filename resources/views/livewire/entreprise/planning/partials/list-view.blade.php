{{-- resources/views/livewire/entreprise/planning/partials/list-view.blade.php --}}
<div class="space-y-4">
    @forelse($entretiens_list as $entretien)
    <div class="card hover:shadow-xl transition-all cursor-pointer" wire:click="openDetailsModal({{ $entretien->id }})">
        <div class="flex items-start gap-4">
            <div class="w-16 h-16 rounded-xl flex items-center justify-center {{ $this->getStatusClass($entretien->status) }}">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <div class="flex-1">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-1">Entretien #{{ $entretien->numero_entretien }}</h3>
                        <p class="text-slate-400 text-sm">{{ $entretien->contrat->libelle }}</p>
                    </div>
                    <span class="status-badge {{ $this->getStatusBadge($entretien->status) }}">
                        {{ $this->getStatusLabel($entretien->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Date prévue</p>
                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($entretien->date_prevue)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Véhicules</p>
                        <p class="text-white font-medium">{{ $entretien->nombre_vehicules_fait }}/{{ $entretien->nombre_vehicules_total }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Coût prévu</p>
                        <p class="text-white font-medium">{{ number_format($entretien->cout_prevu) }} FCFA</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Progression</p>
                        <div class="w-full bg-slate-700 rounded-full h-2 mt-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ ($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="card text-center py-16">
        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">Aucun entretien planifié</h3>
        <p class="text-slate-400">Il n'y a aucun entretien correspondant à vos critères.</p>
    </div>
    @endforelse
</div>
