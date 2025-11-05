<div>

        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-white">
                    Planning de maintenance
                </h1>
                <p class="text-slate-400 mt-1">
                    @if($viewMode === 'calendar')
                        {{ $stats['total_mois'] }} entretien(s) planifié(s) ce mois-ci
                    @else
                        {{ $stats['total_mois'] }} entretien(s) au total
                    @endif
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button wire:click="exportPlanning" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Exporter
                </button>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat-card bg-blue-500/10 border-blue-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label text-blue-400">Entretiens ce mois</p>
                        <p class="stat-value text-blue-400">{{ $stats['total_mois'] }}</p>
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
                        <p class="stat-value text-orange-400">{{ $stats['en_attente'] }}</p>
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
                        <p class="stat-label text-green-400">En cours</p>
                        <p class="stat-value text-green-400">{{ $stats['en_cours'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-blue-500/10 border-blue-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label text-blue-400">Terminés</p>
                        <p class="stat-value text-blue-400">{{ $stats['termines'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & View Toggle -->
        <div class="card mt-6 mb-3">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Filters -->
                    <!-- Filters -->
                    <div class="flex-1 flex flex-col sm:flex-row gap-3">
                        <select wire:model.live="contratFilter"
                                class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les contrats</option>
                            @foreach($contrats as $contrat)
                                <option value="{{ $contrat->id }}">{{ $contrat->libelle }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="statusFilter"
                                class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="PENDING">En attente</option>
                            <option value="IN_PROGRESS">En cours</option>
                            <option value="COMPLETED">Terminé</option>
                            <option value="CANCELLED">Annulé</option>
                        </select>

                        <button wire:click="$set('contratFilter', ''); $set('statusFilter', '')"
                                class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white hover:bg-slate-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </div>
            </div>
        </div>

        <!-- Loading -->
        <div wire:loading.delay class="flex justify-center py-12 ">
            <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-blue-500 border-r-transparent"></div>
        </div>

        <div wire:loading.remove>
            <!-- Calendar View -->
            @if($viewMode === 'calendar')
                @include('livewire.entreprise.planning.partials.calendar-view')
            @endif

            <div class="mt-6"></div>
            <!-- List View -->
            {{-- @if($viewMode === 'list') --}}
                @include('livewire.entreprise.planning.partials.list-view')
            {{-- @endif --}}
        </div>


    <!-- Modal Details -->
    @include('livewire.entreprise.planning.modals.details-entretien')

</div>
