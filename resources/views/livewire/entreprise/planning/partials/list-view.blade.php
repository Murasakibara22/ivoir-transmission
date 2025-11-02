<div class="space-y-6">
    @php
        $today = \Carbon\Carbon::today();
        $todayEntretiens = $historiques->filter(fn($h) => \Carbon\Carbon::parse($h->date_entretient)->isToday());
        $futureEntretiens = $historiques->filter(fn($h) => \Carbon\Carbon::parse($h->date_entretient)->isFuture());
        $pastEntretiens = $historiques->filter(fn($h) => \Carbon\Carbon::parse($h->date_entretient)->isPast() && !\Carbon\Carbon::parse($h->date_entretient)->isToday());
    @endphp

    <!-- Entretiens Aujourd'hui -->
    @if($todayEntretiens->count() > 0)
    <div>
        <div class="flex items-center gap-2 mb-4">
            <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></div>
            <h3 class="text-lg font-bold text-white">Aujourd'hui</h3>
            <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                {{ $todayEntretiens->count() }}
            </span>
        </div>
        <div class="space-y-4">
            @foreach($todayEntretiens as $historique)
                @include('livewire.entreprise.planning.partials.entretien-card')
            @endforeach
        </div>
    </div>
    @endif

    <!-- Entretiens à Venir -->
    @if($futureEntretiens->count() > 0)
    <div>
        <div class="flex items-center gap-2 mb-4">
            <div class="w-2 h-2 rounded-full bg-green-500"></div>
            <h3 class="text-lg font-bold text-white">À venir</h3>
            <span class="status-badge bg-green-500/10 text-green-400 border border-green-500/20">
                {{ $futureEntretiens->count() }}
            </span>
        </div>
        <div class="space-y-4">
            @foreach($futureEntretiens as $historique)
                @include('livewire.entreprise.planning.partials.entretien-card')
            @endforeach
        </div>
    </div>
    @endif

    <!-- Entretiens Passés -->
    @if($pastEntretiens->count() > 0)
    <div>
        <div class="flex items-center gap-2 mb-4">
            <div class="w-2 h-2 rounded-full bg-slate-500"></div>
            <h3 class="text-lg font-bold text-white">Passés</h3>
            <span class="status-badge bg-slate-500/10 text-slate-400 border border-slate-500/20">
                {{ $pastEntretiens->count() }}
            </span>
        </div>
        <div class="space-y-4">
            @foreach($pastEntretiens as $historique)
                @include('livewire.entreprise.planning.partials.entretien-card')
            @endforeach
        </div>
    </div>
    @endif

    <!-- Empty State -->
    @if($historiques->count() === 0)
    <div class="card text-center py-16">
        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">Aucun entretien trouvé</h3>
        <p class="text-slate-400">Aucun entretien avec les filtres sélectionnés.</p>
    </div>
    @endif
</div>
