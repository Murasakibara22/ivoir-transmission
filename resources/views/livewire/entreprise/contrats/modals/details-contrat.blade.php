<!-- Modal Détails Contrat -->
@if($showDetailsModal && $selectedContrat)
<div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.75);">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" wire:click="closeDetailsModal">
            <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
        </div>

        <!-- Modal Panel -->
        <div class="inline-block align-bottom bg-slate-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full border border-slate-700">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600/20 to-blue-500/20 px-6 py-4 border-b border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Détails du contrat</h3>
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
                <!-- Header Info -->
                <div class="bg-slate-700/30 rounded-xl p-6 mb-6 border border-slate-600/50">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-xl flex items-center justify-center border border-blue-500/30">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white mb-2">{{ $selectedContrat->libelle }}</h2>
                                @if($selectedContrat->description)
                                    <p class="text-slate-400 text-sm">{{ $selectedContrat->description }}</p>
                                @endif
                            </div>
                        </div>
                        <div>
                            @if($selectedContrat->status === 'ACTIVE')
                                <span class="status-badge status-success">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Actif
                                </span>
                            @elseif($selectedContrat->status === 'PENDING')
                                <span class="status-badge status-warning">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    En attente
                                </span>
                            @elseif($selectedContrat->status === 'EXPIRED')
                                <span class="status-badge status-urgent">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Expiré
                                </span>
                            @else
                                <span class="status-badge bg-slate-700/50 text-slate-400 border border-slate-600/50">{{ $selectedContrat->status }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informations Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Informations du contrat -->
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informations du contrat
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Fréquence entretien</span>
                                <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    {{ $selectedContrat->frequence_entretien }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Durée du contrat</span>
                                <span class="text-white font-semibold">{{ $selectedContrat->duree_contrat_mois }} mois</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Date de début</span>
                                <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($selectedContrat->date_debut)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Date de fin</span>
                                <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($selectedContrat->date_fin)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Premier entretien</span>
                                <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($selectedContrat->date_premier_entretien)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-slate-400 text-sm">Validation garage</span>
                                @if($selectedContrat->garage_validated_at)
                                    <span class="status-badge status-success">
                                        {{ \Carbon\Carbon::parse($selectedContrat->garage_validated_at)->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-slate-500 text-sm">Non validé</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tarification -->
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Tarification
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Nombre de véhicules</span>
                                <span class="status-badge bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                    {{ $selectedContrat->nombre_vehicules }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Montant par entretien</span>
                                <span class="text-2xl font-bold text-blue-400">{{ number_format($selectedContrat->montant_entretien) }} <span class="text-sm text-slate-400">FCFA</span></span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/30">
                                <span class="text-slate-400 text-sm">Nombre d'entretiens prévus</span>
                                <span class="text-white font-semibold">
                                    @php
                                        $nbEntretiens = 0;
                                        switch($selectedContrat->frequence_entretien) {
                                            case 'MENSUEL':
                                                $nbEntretiens = $selectedContrat->duree_contrat_mois;
                                                break;
                                            case 'TRIMESTRIEL':
                                                $nbEntretiens = ceil($selectedContrat->duree_contrat_mois / 3);
                                                break;
                                            case 'SEMESTRIEL':
                                                $nbEntretiens = ceil($selectedContrat->duree_contrat_mois / 6);
                                                break;
                                            case 'ANNUEL':
                                                $nbEntretiens = ceil($selectedContrat->duree_contrat_mois / 12);
                                                break;
                                        }
                                    @endphp
                                    {{ $nbEntretiens }} entretiens
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 bg-green-500/10 rounded-lg px-3">
                                <span class="text-green-400 text-sm font-semibold">Coût total estimé</span>
                                <span class="text-2xl font-bold text-green-400">{{ number_format($nbEntretiens * $selectedContrat->montant_entretien) }} <span class="text-sm text-slate-400">FCFA</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Entretiens planifiés -->
                <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Entretiens planifiés
                        </h3>
                        <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            {{ $selectedContrat->entretiens->count() }}
                        </span>
                    </div>

                    @if($selectedContrat->entretiens->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-600/50">
                                    <th class="text-left py-3 px-2 text-slate-400 text-sm font-semibold">N°</th>
                                    <th class="text-left py-3 px-2 text-slate-400 text-sm font-semibold">Date prévue</th>
                                    <th class="text-left py-3 px-2 text-slate-400 text-sm font-semibold">Véhicules</th>
                                    <th class="text-left py-3 px-2 text-slate-400 text-sm font-semibold">Progression</th>
                                    <th class="text-left py-3 px-2 text-slate-400 text-sm font-semibold">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedContrat->entretiens->sortBy('date_prevue') as $entretien)
                                <tr class="border-b border-slate-600/30 hover:bg-slate-700/20 transition-colors">
                                    <td class="py-3 px-2">
                                        <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            #{{ $entretien->numero_entretien }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 text-white text-sm">{{ \Carbon\Carbon::parse($entretien->date_prevue)->format('d/m/Y') }}</td>
                                    <td class="py-3 px-2 text-slate-400 text-sm">{{ $entretien->nombre_vehicules_fait }} / {{ $entretien->nombre_vehicules_total }}</td>
                                    <td class="py-3 px-2">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 bg-slate-600/50 rounded-full h-2 overflow-hidden">
                                                <div class="bg-blue-500 h-full transition-all duration-300"
                                                     style="width: {{ ($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100 }}%">
                                                </div>
                                            </div>
                                            <span class="text-xs text-slate-400 whitespace-nowrap">
                                                {{ round(($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100) }}%
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-2">
                                        @if($entretien->status === 'COMPLETED')
                                            <span class="status-badge status-success">Terminé</span>
                                        @elseif($entretien->status === 'IN_PROGRESS')
                                            <span class="status-badge status-warning">En cours</span>
                                        @else
                                            <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">En attente</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            </svg>
                        </div>
                        <p class="text-slate-400">Aucun entretien planifié</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-slate-700/30 px-6 py-4 border-t border-slate-700 flex flex-wrap gap-3 justify-end">
                <button wire:click="closeDetailsModal" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Fermer
                </button>
                @if($selectedContrat->status === 'PENDING')
                <button wire:click="openConfirmModal({{ $selectedContrat->id }}); closeDetailsModal()" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Confirmer le contrat
                </button>
                @endif
                <button wire:click="downloadContrat({{ $selectedContrat->id }})" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Télécharger
                </button>
            </div>
        </div>
    </div>
</div>
@endif
