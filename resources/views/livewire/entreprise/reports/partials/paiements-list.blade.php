<div class="card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-700/30 border-b border-slate-700/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Référence
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Utilisateur
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Montant
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Méthode
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/30">
                @forelse($paiements as $paiement)
                <tr class="hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3
                                {{ $paiement->status === 'PAYE' ? 'bg-green-500/10' : '' }}
                                {{ $paiement->status === 'PENDING' ? 'bg-orange-500/10' : '' }}
                                {{ $paiement->status === 'FAILED' ? 'bg-red-500/10' : '' }}">
                                <svg class="w-5 h-5
                                    {{ $paiement->status === 'PAYE' ? 'text-green-400' : '' }}
                                    {{ $paiement->status === 'PENDING' ? 'text-orange-400' : '' }}
                                    {{ $paiement->status === 'FAILED' ? 'text-red-400' : '' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-white">{{ $paiement->reference }}</div>
                                <div class="text-xs text-slate-500">
                                    @if($paiement->model_type === 'App\Models\Facture')
                                    Facture
                                    @else
                                    Réservation
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($paiement->user)
                        <div class="text-sm text-white">{{ $paiement->user->username ?? 'N/A' }}</div>
                        <div class="text-xs text-slate-500">{{ $paiement->user->phone ?? '' }}</div>
                        @else
                        <span class="text-sm text-slate-500">-</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-white">{{ number_format($paiement->montant) }} FCFA</div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($paiement->methode)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            {{ $paiement->methode }}
                        </span>
                        @else
                        <span class="text-sm text-slate-500">-</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $paiement->status }}
                        @if($paiement->status === 'PAYE')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Payé
                        </span>
                        @elseif($paiement->status === 'PENDING')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-500/10 text-orange-400 border border-orange-500/20">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            En attente
                        </span>
                        @elseif($paiement->status === 'INITIATED')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            Initié
                        </span>

                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Échoué
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-300">
                            {{ \Carbon\Carbon::parse($paiement->created_at)->format('d/m/Y') }}
                        </div>
                        <div class="text-xs text-slate-500">
                            {{ \Carbon\Carbon::parse($paiement->created_at)->format('H:i') }}
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <button wire:click="openDetailsPaiement({{ $paiement->id }})"
                                class="inline-flex items-center px-3 py-1.5 bg-slate-700/50 hover:bg-slate-700 border border-slate-600/50 rounded-lg text-sm text-white transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Détails
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Aucun paiement trouvé</h3>
                        <p class="text-slate-400">Aucun paiement ne correspond à vos critères de recherche.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($paiements->hasPages())
    <div class="px-6 py-4 border-t border-slate-700/50">
        {{ $paiements->links() }}
    </div>
    @endif
</div>
