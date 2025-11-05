<?php

namespace App\Livewire\Entreprise;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EntrepriseDashboard extends Component
{
    public function getStatsProperty()
    {
        $entreprise = auth('entreprise')->user();

        // Total véhicules
        $totalVehicules = $entreprise->vehicules()->count();

        // Véhicules du mois dernier pour comparaison
        $vehiculesMoisDernier = $entreprise->vehicules()
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $vehiculesCeMois = $entreprise->vehicules()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Alertes urgentes (maintenance dans les 5 prochains jours)
        $alertesUrgentes = DB::table('historique_entretients as he')
            ->join('vehicules as v', 'he.vehicule_id', '=', 'v.id')
            ->where('v.entreprise_id', $entreprise->id)
            ->whereNotNull('he.prochain_entretien_date')
            ->where('he.prochain_entretien_date', '<=', now()->addDays(5))
            ->distinct('v.id')
            ->count('v.id');

        // Entretiens cette semaine (via entretiens table)
        $entretiensSemaine = $entreprise->entretiens()
            ->whereBetween('date_prevue', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        // Entretiens semaine dernière
        $entretiensSemaineDerniere = $entreprise->entretiens()
            ->whereBetween('date_prevue', [
                now()->subWeek()->startOfWeek(),
                now()->subWeek()->endOfWeek()
            ])
            ->count();

        // Coût ce mois (somme des cout_final des entretiens complétés)
        $coutCeMois = $entreprise->entretiens()
            ->where('status', 'COMPLETED')
            ->whereMonth('date_realisation', now()->month)
            ->whereYear('date_realisation', now()->year)
            ->sum('cout_final');

        // Coût mois dernier
        $coutMoisDernier = $entreprise->entretiens()
            ->where('status', 'COMPLETED')
            ->whereMonth('date_realisation', now()->subMonth()->month)
            ->whereYear('date_realisation', now()->subMonth()->year)
            ->sum('cout_final');

        // Calcul des variations
        $variationVehicules = $vehiculesCeMois;
        $variationEntretiens = $entretiensSemaine - $entretiensSemaineDerniere;
        $variationCout = $coutMoisDernier > 0
            ? round((($coutCeMois - $coutMoisDernier) / $coutMoisDernier) * 100, 1)
            : 0;

        return [
            'total_vehicules' => $totalVehicules,
            'variation_vehicules' => $variationVehicules,
            'alertes_urgentes' => $alertesUrgentes,
            'entretiens_semaine' => $entretiensSemaine,
            'variation_entretiens' => $variationEntretiens,
            'cout_mois' => $coutCeMois,
            'variation_cout' => $variationCout,
        ];
    }

    public function getAlertesUrgentesProperty()
    {
        $entreprise = auth('entreprise')->user();

        // Récupérer les véhicules avec maintenance urgente
        return $entreprise->vehicules()
            ->whereHas('historique_entretiens', function($query) {
                $query->whereNotNull('prochain_entretien_date')
                      ->where('prochain_entretien_date', '<=', now()->addDays(5));
            })
            ->with(['historique_entretiens' => function($query) {
                $query->whereNotNull('prochain_entretien_date')
                      ->orderBy('prochain_entretien_date', 'asc')
                      ->limit(1);
            }])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function($vehicule) {
                $dernierEntretien = $vehicule->historique_entretiens->first();

                return [
                    'vehicule' => $vehicule,
                    'type' => $dernierEntretien->type_entretient ?? 'Maintenance',
                    'date_prevue' => $dernierEntretien->prochain_entretien_date ?? null,
                    'kilometrage' => $dernierEntretien->prochain_entretien_km ?? null,
                    'is_overdue' => $dernierEntretien && Carbon::parse($dernierEntretien->prochain_entretien_date)->isPast(),
                    'jours_restants' => $dernierEntretien
                        ? now()->diffInDays(Carbon::parse($dernierEntretien->prochain_entretien_date), false)
                        : null,
                ];
            });
    }

    public function getProchainsRendezVousProperty()
    {
        $entreprise = auth('entreprise')->user();

        // Récupérer les prochains entretiens planifiés
        return $entreprise->entretiens()
            ->where('status', 'PENDING')
            ->where('date_prevue', '>=', now())
            ->with(['historique_entretiens'])
            ->orderBy('date_prevue', 'asc')
            ->limit(3)
            ->get()
            ->map(function($entretien) {
                return [
                    'entretien' => $entretien,
                    'date' => Carbon::parse($entretien->date_prevue),
                    'vehicules_count' => $entretien->nombre_vehicules_total,
                    'is_today' => Carbon::parse($entretien->date_prevue)->isToday(),
                    'is_tomorrow' => Carbon::parse($entretien->date_prevue)->isTomorrow(),
                ];
            });
    }

    public function getVehiculesRecentsProperty()
    {
        $entreprise = auth('entreprise')->user();

        return $entreprise->vehicules()
            ->with(['historique_entretiens' => function($query) {
                $query->whereNotNull('prochain_entretien_date')
                      ->orderBy('prochain_entretien_date', 'asc')
                      ->limit(1);
            }])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function($vehicule) {
                $dernierEntretien = $vehicule->historique_entretiens->first();

                // Déterminer le statut
                $status = 'unknown';
                if ($dernierEntretien && $dernierEntretien->prochain_entretien_date) {
                    $dateProchaine = Carbon::parse($dernierEntretien->prochain_entretien_date);
                    $joursRestants = now()->diffInDays($dateProchaine, false);

                    if ($joursRestants < 0 || $joursRestants <= 5) {
                        $status = 'urgent';
                    } elseif ($joursRestants <= 14) {
                        $status = 'warning';
                    } else {
                        $status = 'success';
                    }
                }

                return [
                    'vehicule' => $vehicule,
                    'status' => $status,
                    'date_ajout' => Carbon::parse($vehicule->created_at),
                ];
            });
    }

    public function getAlertMessage($alerte)
    {
        if ($alerte['is_overdue']) {
            $joursRetard = abs($alerte['jours_restants']);
            return "Dépassé de {$joursRetard} jour(s)";
        } else {
            $jours = $alerte['jours_restants'];
            return "Dans {$jours} jour(s)";
        }
    }

    public function getAlertBgClass($alerte)
    {
        if ($alerte['is_overdue']) {
            return 'bg-red-500/10 border-red-500/20';
        } elseif ($alerte['jours_restants'] <= 2) {
            return 'bg-orange-500/10 border-orange-500/20';
        } else {
            return 'bg-yellow-500/10 border-yellow-500/20';
        }
    }

    public function getAlertIconBgClass($alerte)
    {
        if ($alerte['is_overdue']) {
            return 'bg-red-500/20';
        } elseif ($alerte['jours_restants'] <= 2) {
            return 'bg-orange-500/20';
        } else {
            return 'bg-yellow-500/20';
        }
    }

    public function getAlertIconColorClass($alerte)
    {
        if ($alerte['is_overdue']) {
            return 'text-red-400';
        } elseif ($alerte['jours_restants'] <= 2) {
            return 'text-orange-400';
        } else {
            return 'text-yellow-400';
        }
    }

    public function getAlertTextColorClass($alerte)
    {
        if ($alerte['is_overdue']) {
            return 'text-red-400';
        } elseif ($alerte['jours_restants'] <= 2) {
            return 'text-orange-400';
        } else {
            return 'text-yellow-400';
        }
    }

    public function getStatusBadgeClass($status)
    {
        return match($status) {
            'urgent' => 'status-badge status-urgent',
            'warning' => 'status-badge status-warning',
            'success' => 'status-badge status-success',
            default => 'status-badge bg-slate-500/10 text-slate-400',
        };
    }

    public function getStatusLabel($status)
    {
        return match($status) {
            'urgent' => 'Urgent',
            'warning' => 'Bientôt',
            'success' => 'À jour',
            default => 'Non défini',
        };
    }

    public function render()
    {
        return view('livewire.entreprise.entreprise-dashboard', [
            'stats' => $this->stats,
            'alertesUrgentes' => $this->alertesUrgentes,
            'prochainsRendezVous' => $this->prochainsRendezVous,
            'vehiculesRecents' => $this->vehiculesRecents,
        ]);
    }
}
