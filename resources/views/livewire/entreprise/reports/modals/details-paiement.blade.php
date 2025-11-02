@if($showDetailsModal && $selectedItem)
<div class="fixed inset-0 z-50 overflow-y-auto animate-fade-in">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" wire:click="closeDetailsModal"></div>

    <!-- Modal -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl border border-slate-700/50 animate-slide-up">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12
                        {{ $selectedItem->status === 'PAID' ? 'bg-green-500/10' : '' }}
                        {{ $selectedItem->status === 'PENDING' ? 'bg-orange-500/10' : '' }}
                        {{ $selectedItem->status === 'FAILED' ? 'bg-red-500/10' : '' }}
                        rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6
                            {{ $selectedItem->status === 'PAID' ? 'text-green-400' : '' }}
                            {{ $selectedItem->status === 'PENDING' ? 'text-orange-400' : '' }}
                            {{ $selectedItem->status === 'FAILED' ? 'text-red-400' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Détails du paiement</h3>
                        <p class="text-sm text-slate-400">{{ $selectedItem->reference }}</p>
                    </div>
                </div>
                <button wire:click="closeDetailsModal" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">

                <!-- Status & Montant -->
                <div class="flex items-center justify-between p-4 bg-slate-700/30 rounded-xl">
                    <div>
                        @if($selectedItem->status === 'PAID')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Paiement réussi
                        </span>
                        @elseif($selectedItem->status === 'PENDING')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-orange-500/10 text-orange-400 border border-orange-500/20">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            En attente
                        </span>
                        @elseif($selectedItem->status === 'INITIATED')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            Initié
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Échoué
                        </span>
                        @endif
                    </div>

                    <div class="text-right">
                        <p class="text-3xl font-bold text-white">{{ number_format($selectedItem->montant) }}</p>
                        <p class="text-sm text-slate-400">FCFA</p>
                    </div>
                </div>

                <!-- Informations principales -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-700/30 rounded-xl">
                        <p class="text-sm text-slate-400 mb-1">Date du paiement</p>
                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($selectedItem->created_at)->format('d/m/Y à H:i') }}</p>
                    </div>

                    @if($selectedItem->methode)
                    <div class="p-4 bg-slate-700/30 rounded-xl">
                        <p class="text-sm text-slate-400 mb-1">Méthode</p>
                        <p class="text-white font-medium">{{ $selectedItem->methode }}</p>
                    </div>
                    @endif

                    @if($selectedItem->user)
                    <div class="p-4 bg-slate-700/30 rounded-xl col-span-2">
                        <p class="text-sm text-slate-400 mb-2">Utilisateur</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ $selectedItem->user->username ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-400">{{ $selectedItem->user->phone ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Type de paiement -->
                <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-400 mb-1">Type de paiement</p>
                            <p class="text-white font-medium">
                                @if($selectedItem->model_type === 'App\Models\Facture')
                                Paiement de facture
                                @else
                                Paiement de réservation
                                @endif
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($selectedItem->model_type === 'App\Models\Facture')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                @endif
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Réservation associée -->
                @if($selectedItem->reservation)
                <div>
                    <h4 class="text-sm font-semibold text-slate-400 mb-3">Réservation associée</h4>
                    <div class="p-4 bg-slate-700/30 rounded-xl">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="text-white font-medium mb-1">{{ $selectedItem->reservation->adresse_name }}</p>
                                <p class="text-sm text-slate-400">
                                    {{ \Carbon\Carbon::parse($selectedItem->reservation->date_debut)->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                {{ $selectedItem->reservation->status }}
                            </span>
                        </div>
                        @if($selectedItem->reservation->chassis)
                        <p class="text-sm text-slate-400">
                            Chassis: <span class="text-white font-mono">{{ $selectedItem->reservation->chassis }}</span>
                        </p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Snapshot Data (si disponible) -->
                @if($selectedItem->snapshot_reservation)
                <div>
                    <h4 class="text-sm font-semibold text-slate-400 mb-3">Informations sauvegardées</h4>
                    <div class="p-4 bg-slate-700/30 rounded-xl space-y-2 text-sm">
                        @php
                            $snapshot = json_decode($selectedItem->snapshot_reservation, true);
                        @endphp
                        @if($snapshot)
                            @if(isset($snapshot['montant']))
                            <div class="flex justify-between">
                                <span class="text-slate-400">Montant initial</span>
                                <span class="text-white">{{ number_format($snapshot['montant']) }} FCFA</span>
                            </div>
                            @endif
                            @if(isset($snapshot['status']))
                            <div class="flex justify-between">
                                <span class="text-slate-400">Statut à la réservation</span>
                                <span class="text-white">{{ $snapshot['status'] }}</span>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-6 border-t border-slate-700/50">
                <button wire:click="closeDetailsModal" class="btn btn-secondary">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(1rem) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.2s ease-out;
    }

    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }
</style>
@endif
