<div class="space-y-6" data-dashboard-view="dashboard">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Bonjour, {{ auth()->guard('entreprise')->user()->name ?? 'Utilisateur' }}
            </h1>
            <p class="text-slate-400 mt-1">
                Voici un aperçu de votre flotte automobile
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('entreprise.reports.index') }}" class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Rapport
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <!-- Total Véhicules -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Total véhicules</p>
                    <p class="stat-value">{{ $stats['total_vehicules'] }}</p>
                    @if($stats['variation_vehicules'] > 0)
                        <p class="stat-change positive">+{{ $stats['variation_vehicules'] }} ce mois</p>
                    @elseif($stats['variation_vehicules'] < 0)
                        <p class="stat-change negative">{{ $stats['variation_vehicules'] }} ce mois</p>
                    @else
                        <p class="stat-change">Aucune variation</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Alertes Urgentes -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Alertes urgentes</p>
                    <p class="stat-value text-red-400">{{ $stats['alertes_urgentes'] }}</p>
                    <p class="stat-change negative">Maintenance requise</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- RDV cette semaine -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">RDV cette semaine</p>
                    <p class="stat-value text-green-400">{{ $stats['entretiens_semaine'] }}</p>
                    @if($stats['variation_entretiens'] > 0)
                        <p class="stat-change positive">+{{ $stats['variation_entretiens'] }} vs semaine passée</p>
                    @elseif($stats['variation_entretiens'] < 0)
                        <p class="stat-change negative">{{ $stats['variation_entretiens'] }} vs semaine passée</p>
                    @else
                        <p class="stat-change">Même niveau</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Coût maintenance -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Coût ce mois</p>
                    <p class="stat-value">{{ number_format($stats['cout_mois'], 0, ',', ' ') }} F</p>
                    @if($stats['variation_cout'] < 0)
                        <p class="stat-change positive">{{ $stats['variation_cout'] }}% vs mois passé</p>
                    @elseif($stats['variation_cout'] > 0)
                        <p class="stat-change negative">+{{ $stats['variation_cout'] }}% vs mois passé</p>
                    @else
                        <p class="stat-change">Stable</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes Urgentes Section -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                Alertes urgentes
            </h2>
            <a href="{{ route('entreprise.vehicules.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                Voir tout
            </a>
        </div>

        <div class="space-y-4">
            @forelse($alertesUrgentes as $alerte)
                <div class="flex items-center p-4 {{ $this->getAlertBgClass($alerte) }} border rounded-xl">
                    <div class="w-12 h-12 {{ $this->getAlertIconBgClass($alerte) }} rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 {{ $this->getAlertIconColorClass($alerte) }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-white font-medium">{{ $alerte['vehicule']->libelle }} - {{ $alerte['vehicule']->matricule }}</h3>
                        <p class="{{ $this->getAlertTextColorClass($alerte) }} text-sm">
                            {{ $alerte['type'] }} - {{ $this->getAlertMessage($alerte) }}
                        </p>
                        @if($alerte['date_prevue'])
                            <p class="text-slate-400 text-xs mt-1">
                                Prévu pour: {{ \Carbon\Carbon::parse($alerte['date_prevue'])->format('d M Y') }}
                            </p>
                        @endif
                    </div>
                    <a href="{{ route('entreprise.maintenance.index') }}" class="btn btn-primary btn-sm">
                        Planifier
                    </a>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-green-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-slate-400">Aucune alerte urgente ! Votre flotte est à jour.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Prochains rendez-vous -->
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Prochains rendez-vous
                </h2>
                <a href="{{ route('entreprise.maintenance.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Planning complet
                </a>
            </div>

            <div class="space-y-4">
                @forelse($prochainsRendezVous as $rdv)
                    <div class="flex items-center p-4 bg-slate-700/30 rounded-xl border border-slate-600/50">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-white font-medium">Entretien #{{ $rdv['entretien']->numero_entretien }}</h3>
                            <p class="text-slate-400 text-sm">{{ $rdv['vehicules_count'] }} véhicule(s)</p>
                            <p class="text-blue-400 text-xs mt-1">
                                @if($rdv['is_today'])
                                    Aujourd'hui à {{ $rdv['date']->format('H:i') }}
                                @elseif($rdv['is_tomorrow'])
                                    Demain à {{ $rdv['date']->format('H:i') }}
                                @else
                                    {{ $rdv['date']->format('d M Y') }} à {{ $rdv['date']->format('H:i') }}
                                @endif
                            </p>
                        </div>
                        <span class="status-badge status-success">Planifié</span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-slate-400">Aucun rendez-vous planifié</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Véhicules récents -->
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                    Véhicules récents
                </h2>
                <a href="{{ route('entreprise.vehicules.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Voir tous
                </a>
            </div>

            <div class="space-y-4">
                @forelse($vehiculesRecents as $item)
                    @php
                        $vehicule = $item['vehicule'];
                        $gradientClass = match($item['status']) {
                            'urgent' => 'from-red-500 to-red-600',
                            'warning' => 'from-orange-500 to-orange-600',
                            'success' => 'from-green-500 to-green-600',
                            default => 'from-blue-500 to-blue-600',
                        };
                    @endphp

                    <a href="#"
                       class="flex items-center p-4 bg-slate-700/30 rounded-xl hover:bg-slate-700/50 transition-colors cursor-pointer">
                        <div class="w-16 h-16 bg-gradient-to-br {{ $gradientClass }} rounded-xl flex items-center justify-center mr-4">
                            @if($vehicule->images && count(json_decode($vehicule->images)) > 0)
                                <img src="{{ json_decode($vehicule->images)[0] }}"
                                     alt="{{ $vehicule->libelle }}"
                                     class="w-full h-full object-cover rounded-xl">
                            @else
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-white font-medium">{{ $vehicule->libelle }} - {{ $vehicule->matricule }}</h3>
                            <p class="text-slate-400 text-sm">Ajouté le {{ $item['date_ajout']->format('d M Y') }}</p>
                            <div class="flex items-center mt-1">
                                <span class="{{ $this->getStatusBadgeClass($item['status']) }}">
                                    {{ $this->getStatusLabel($item['status']) }}
                                </span>
                                <span class="text-slate-400 text-xs ml-2">{{ number_format($vehicule->kilometrage_actuel) }} km</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <p class="text-slate-400">Aucun véhicule</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h2 class="text-xl font-semibold text-white mb-6">Actions rapides</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Ajouter véhicule -->
            {{-- <a href="#"
               class="flex flex-col items-center p-6 bg-blue-500/10 border border-blue-500/20 rounded-xl hover:bg-blue-500/20 transition-colors group">
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Ajouter véhicule</span>
            </a> --}}

            <!-- Planifier maintenance -->
            <a href="{{ route('entreprise.maintenance.index') }}"
               class="flex flex-col items-center p-6 bg-green-500/10 border border-green-500/20 rounded-xl hover:bg-green-500/20 transition-colors group">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Planifier maintenance</span>
            </a>

            <!-- Voir rapports -->
            <a href="{{ route('entreprise.reports.index') }}"
               class="flex flex-col items-center p-6 bg-purple-500/10 border border-purple-500/20 rounded-xl hover:bg-purple-500/20 transition-colors group">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Voir rapports</span>
            </a>

            <!-- Gérer contrats -->
            <a href="{{ route('entreprise.contrats.index') }}"
               class="flex flex-col items-center p-6 bg-orange-500/10 border border-orange-500/20 rounded-xl hover:bg-orange-500/20 transition-colors group">
                <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Gérer contrats</span>
            </a>
        </div>
    </div>
</div>
