{{-- resources/views/livewire/entreprise/reports/partials/charts.blade.php --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Évolution des dépenses -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-white">Évolution des dépenses</h3>
            <select wire:model.live="chartPeriod" class="px-3 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="6">6 derniers mois</option>
                <option value="12">12 derniers mois</option>
                <option value="year">Cette année</option>
            </select>
        </div>

        <div class="chart-container h-64">
            <canvas id="depensesChart" wire:ignore></canvas>
        </div>
    </div>

    <!-- Répartition par type -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-white">Répartition par type</h3>
        </div>

        <div class="chart-container h-64">
            <canvas id="repartitionChart" wire:ignore></canvas>
        </div>

        <!-- Legend -->
        <div class="grid grid-cols-2 gap-3 mt-4">
            @foreach($repartitionData as $index => $item)
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full" style="background-color: {{ $item['color'] }}"></div>
                <span class="text-sm text-slate-400">{{ $item['label'] }} ({{ $item['percentage'] }}%)</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('livewire:init', () => {
    let depensesChart = null;
    let repartitionChart = null;

    // Graphique d'évolution
    function initDepensesChart(data) {
        const ctx = document.getElementById('depensesChart');
        if (!ctx) return;

        if (depensesChart) {
            depensesChart.destroy();
        }

        depensesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Dépenses',
                    data: data.values,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#94a3b8' },
                        grid: { color: 'rgba(71, 85, 105, 0.3)' }
                    },
                    x: {
                        ticks: { color: '#94a3b8' },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // Graphique de répartition
    function initRepartitionChart(data) {
        const ctx = document.getElementById('repartitionChart');
        if (!ctx) return;

        if (repartitionChart) {
            repartitionChart.destroy();
        }

        repartitionChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.values,
                    backgroundColor: data.colors,
                    borderWidth: 2,
                    borderColor: '#1e293b'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    // Init charts
    @this.on('updateCharts', (data) => {
        initDepensesChart(data[0].depenses);
        initRepartitionChart(data[0].repartition);
    });

    // Initial load
    initDepensesChart(@json($depensesChartData));
    initRepartitionChart(@json($repartitionChartData));
});
</script>
@endpush
