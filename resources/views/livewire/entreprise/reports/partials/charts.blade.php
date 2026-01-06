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

        <div class="chart-container h-64" wire:ignore>
            <canvas id="depensesChart"></canvas>
        </div>
    </div>

    <!-- Répartition par type -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-white">Répartition par type</h3>
        </div>

        <div class="chart-container h-64" wire:ignore>
            <canvas id="repartitionChart"></canvas>
        </div>

        <!-- Legend -->
        <div class="grid grid-cols-2 gap-3 mt-4">
            @forelse($repartitionData as $item)
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full" style="background-color: {{ $item['color'] }}"></div>
                <span class="text-sm text-slate-400">{{ $item['label'] }} ({{ $item['percentage'] }}%)</span>
            </div>
            @empty
            <div class="col-span-2 text-center text-slate-500 text-sm">Aucune donnée disponible</div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
let depensesChart = null;
let repartitionChart = null;

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
                label: 'Dépenses (FCFA)',
                data: data.values,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#94a3b8',
                        font: { size: 12 }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 41, 59, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#94a3b8',
                    borderColor: 'rgba(59, 130, 246, 0.5)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return new Intl.NumberFormat('fr-FR').format(context.parsed.y) + ' FCFA';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11 },
                        callback: function(value) {
                            return new Intl.NumberFormat('fr-FR', {
                                notation: 'compact',
                                compactDisplay: 'short'
                            }).format(value);
                        }
                    },
                    grid: {
                        color: 'rgba(71, 85, 105, 0.3)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

function initRepartitionChart(data) {
    const ctx = document.getElementById('repartitionChart');
    if (!ctx) return;

    if (repartitionChart) {
        repartitionChart.destroy();
    }

    if (!data.values || data.values.length === 0 || data.values.every(v => v === 0)) {
        ctx.getContext('2d').clearRect(0, 0, ctx.width, ctx.height);
        const parent = ctx.parentElement;
        parent.innerHTML = '<div class="flex items-center justify-center h-64"><p class="text-slate-500 text-sm">Aucune donnée disponible</p></div>';
        return;
    }

    repartitionChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: data.colors,
                borderWidth: 3,
                borderColor: '#1e293b',
                hoverBorderWidth: 4,
                hoverBorderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 41, 59, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#94a3b8',
                    borderColor: 'rgba(71, 85, 105, 0.5)',
                    borderWidth: 1,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = new Intl.NumberFormat('fr-FR').format(context.parsed);
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                            return `${label}: ${value} FCFA (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const depensesData = @json($depensesChartData);
    const repartitionData = @json($repartitionChartData);

    initDepensesChart(depensesData);
    initRepartitionChart(repartitionData);
});

document.addEventListener('livewire:init', () => {
    Livewire.on('updateCharts', (event) => {
        initDepensesChart(event.depenses);
        initRepartitionChart(event.repartition);
    });
});
</script>
@endpush
