<!-- Modal Détails Entretien -->
@if($showDetailsModal && $selectedHistorique)
<div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.75);">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" wire:click="closeDetailsModal">
            <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
        </div>

        <!-- Modal Panel -->
        <div class="inline-block align-bottom bg-slate-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-slate-700">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600/20 to-blue-500/20 px-6 py-4 border-b border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center border border-blue-500/30">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Détails de l'entretien</h3>
                            <p class="text-sm text-slate-400 mt-1">{{ $selectedHistorique->type_entretient }}</p>
                        </div>
                    </div>
                    <button wire:click="closeDetailsModal" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 py-6 max-h-[70vh] overflow-y-auto">
                <!-- Status Badge -->
                <div class="mb-6">
                    <span class="status-badge {{ $this->getStatusBadge($selectedHistorique->status) }} text-base">
                        {{ $this->getStatusLabel($selectedHistorique->status) }}
                    </span>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Véhicule -->
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                        <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            Véhicule
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Libellé</span>
                                <span class="text-white font-semibold">{{ $selectedHistorique->vehicule->libelle }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Immatriculation</span>
                                <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    {{ $selectedHistorique->vehicule->matricule }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Marque</span>
                                <span class="text-white font-semibold">{{ $selectedHistorique->vehicule->marque }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-slate-400 text-sm">Modèle</span>
                                <span class="text-white font-semibold">{{ $selectedHistorique->vehicule->modele ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Planification -->
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                        <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Planification
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Date prévue</span>
                                <span class="text-white font-semibold">
                                    {{ \Carbon\Carbon::parse($selectedHistorique->date_entretient)->format('d/m/Y à H:i') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Type d'entretien</span>
                                <span class="text-white font-semibold">{{ $selectedHistorique->type_entretient }}</span>
                            </div>
                            @if($selectedHistorique->kilometrage_intervention)
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Kilométrage</span>
                                <span class="text-white font-semibold">{{ number_format($selectedHistorique->kilometrage_intervention) }} km</span>
                            </div>
                            @endif
                            @if($selectedHistorique->entretien)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-slate-400 text-sm">N° Entretien</span>
                                <span class="status-badge bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                    #{{ $selectedHistorique->entretien->numero_entretien }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contrat Info -->
                @if($selectedHistorique->contrat)
                <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50 mb-6">
                    <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Contrat associé
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-slate-800/50 rounded-lg p-4">
                            <p class="text-slate-400 text-xs mb-1">Libellé</p>
                            <p class="text-white font-semibold">{{ $selectedHistorique->contrat->libelle }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-lg p-4">
                            <p class="text-slate-400 text-xs mb-1">Fréquence</p>
                            <p class="text-white font-semibold">{{ $selectedHistorique->contrat->frequence_entretien }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-lg p-4">
                            <p class="text-slate-400 text-xs mb-1">Montant</p>
                            <p class="text-green-400 font-bold">{{ number_format($selectedHistorique->contrat->montant_entretien) }} FCFA</p>
                        </div>
                    </div>
                </div>
                @endif



                <!-- Liste des véhicules de l'entretien -->
                @if($selectedHistorique->entretien && $selectedHistorique->entretien->historique_entretiens->count() > 0)
                <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Véhicules de l'entretien
                        </h4>
                        <div class="flex items-center gap-2">
                            <span class="status-badge status-success">
                                {{ $selectedHistorique->entretien->nombre_vehicules_fait }} fait(s)
                            </span>
                            <span class="status-badge status-warning">
                                {{ $selectedHistorique->entretien->nombre_vehicules_restant }} restant(s)
                            </span>
                        </div>
                    </div>

                    <!-- Barre de progression -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-slate-400 mb-2">
                            <span>Progression globale</span>
                            <span class="font-semibold">
                                {{ round(($selectedHistorique->entretien->nombre_vehicules_fait / $selectedHistorique->entretien->nombre_vehicules_total) * 100) }}%
                            </span>
                        </div>
                        <div class="w-full bg-slate-600/50 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-green-400 h-full transition-all duration-300"
                                style="width: {{ ($selectedHistorique->entretien->nombre_vehicules_fait / $selectedHistorique->entretien->nombre_vehicules_total) * 100 }}%">
                            </div>
                        </div>
                    </div>

                    <!-- Liste des véhicules -->
                    <div class="space-y-3">
                        @foreach($selectedHistorique->entretien->historique_entretiens->sortBy('created_at') as $index => $historique)
                        <div class="bg-slate-800/50 rounded-lg p-4 border {{ $historique->status === 'DONE' ? 'border-green-500/30' : 'border-slate-600/30' }} transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3 flex-1">
                                    <!-- Numéro -->
                                    <div class="w-8 h-8 bg-slate-700 rounded-lg flex items-center justify-center">
                                        <span class="text-sm font-bold text-slate-300">{{ $index + 1 }}</span>
                                    </div>

                                    <!-- Icône véhicule -->
                                    <div class="w-10 h-10 {{ $historique->status === 'DONE' ? 'bg-green-500/20' : 'bg-slate-700' }} rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 {{ $historique->status === 'DONE' ? 'text-green-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                        </svg>
                                    </div>

                                    <!-- Infos véhicule -->
                                    <div class="flex-1">
                                        <h5 class="text-white font-semibold">{{ $historique->vehicule->libelle }}</h5>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                                {{ $historique->vehicule->matricule }}
                                            </span>
                                            <span class="text-xs text-slate-400">{{ $historique->vehicule->marque }}</span>
                                        </div>
                                    </div>

                                    <!-- Statut -->
                                    <div>
                                        @if($historique->status === 'DONE')
                                            <span class="status-badge status-success">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Fait
                                            </span>
                                        @elseif($historique->status === 'IN_PROGRESS')
                                            <span class="status-badge status-warning">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                En cours
                                            </span>
                                        @else
                                            <span class="status-badge bg-slate-600/50 text-slate-300 border border-slate-600">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                En attente
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Détails additionnels si disponibles -->
                            @if($historique->status === 'DONE' && ($historique->cout_pieces || $historique->cout_main_oeuvre))
                            <div class="mt-3 pt-3 border-t border-slate-700/50 flex items-center gap-4 text-sm">
                                @if($historique->cout_pieces)
                                <span class="text-slate-400">
                                    Pièces: <span class="text-white font-semibold">{{ number_format($historique->cout_pieces) }} FCFA</span>
                                </span>
                                @endif
                                @if($historique->cout_main_oeuvre)
                                <span class="text-slate-400">
                                    Main d'œuvre: <span class="text-white font-semibold">{{ number_format($historique->cout_main_oeuvre) }} FCFA</span>
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <!-- Résumé -->
                    <div class="mt-4 pt-4 border-t border-slate-700/50">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-slate-800/50 rounded-lg p-3">
                                <p class="text-slate-400 text-xs mb-1">Total</p>
                                <p class="text-2xl font-bold text-white">{{ $selectedHistorique->entretien->nombre_vehicules_total }}</p>
                            </div>
                            <div class="bg-green-500/10 border border-green-500/30 rounded-lg p-3">
                                <p class="text-green-400 text-xs mb-1">Faits</p>
                                <p class="text-2xl font-bold text-green-400">{{ $selectedHistorique->entretien->nombre_vehicules_fait }}</p>
                            </div>
                            <div class="bg-orange-500/10 border border-orange-500/30 rounded-lg p-3">
                                <p class="text-orange-400 text-xs mb-1">Restants</p>
                                <p class="text-2xl font-bold text-orange-400">{{ $selectedHistorique->entretien->nombre_vehicules_restant }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif



                <!-- Détails techniques -->
                @if($selectedHistorique->description_intervention || $selectedHistorique->pieces_changees || $selectedHistorique->observations)
                <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                    <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Détails techniques
                    </h4>

                    @if($selectedHistorique->description_intervention)
                    <div class="mb-4">
                        <p class="text-slate-400 text-sm mb-2">Description</p>
                        <p class="text-white">{{ $selectedHistorique->description_intervention }}</p>
                    </div>
                    @endif

                    @if($selectedHistorique->pieces_changees)
                    <div class="mb-4">
                        <p class="text-slate-400 text-sm mb-2">Pièces changées</p>
                        <p class="text-white">{{ $selectedHistorique->pieces_changees }}</p>
                    </div>
                    @endif

                    @if($selectedHistorique->observations)
                    <div>
                        <p class="text-slate-400 text-sm mb-2">Observations</p>
                        <p class="text-white">{{ $selectedHistorique->observations }}</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="bg-slate-700/30 px-6 py-4 border-t border-slate-700 flex justify-end gap-3">
                <button wire:click="closeDetailsModal" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>
@endif
