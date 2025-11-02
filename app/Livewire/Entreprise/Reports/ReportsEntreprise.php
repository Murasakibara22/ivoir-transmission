<?php

namespace App\Livewire\Entreprise\Reports;

use App\Models\Facture;
use Livewire\Component;
use App\Models\Paiement;
use Livewire\WithPagination;
use App\Services\PaymentService;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportsEntreprise extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Onglets
    public $activeTab = 'factures'; // 'factures' ou 'paiements'

    // Filters
    public $search = '';
    public $statusFilter = '';
    public $periodFilter = '';
    public $startDate = '';
    public $endDate = '';

    // Modals
    public $showDetailsModal = false;
    public $selectedItem = null;
    public $showPaiementModal = false;
    public $selectedFacture = null;

    public $contact_paiement;

    // Paiement Form
    public $montant_paiement = 0;
    public $moyen_paiement = '';
    public $reference_paiement = '';
    public $note_paiement = '';

    //  Graphs
    public $chartPeriod = '6';
    public $repartitionData;
    public $depensesChartData;
    public $repartitionChartData;

    protected $queryString = [
        'activeTab' => ['except' => 'factures'],
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function mount()
    {
        if (!Auth::guard('entreprise')->check()) {
            return redirect()->route('entreprise.login');
        }

        $this->repartitionData = $this->getRepartitionDataProperty();
        $this->depensesChartData = $this->getDepensesChartDataProperty();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPeriodFilter()
    {
        $this->resetPage();
        $this->applyPeriodFilter();
    }

    public function applyPeriodFilter()
    {
        $now = now();

        switch($this->periodFilter) {
            case 'mois':
                $this->startDate = $now->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->endOfMonth()->format('Y-m-d');
                break;
            case 'trimestre':
                $this->startDate = $now->startOfQuarter()->format('Y-m-d');
                $this->endDate = $now->endOfQuarter()->format('Y-m-d');
                break;
            case 'annee':
                $this->startDate = $now->startOfYear()->format('Y-m-d');
                $this->endDate = $now->endOfYear()->format('Y-m-d');
                break;
            default:
                $this->startDate = '';
                $this->endDate = '';
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
        $this->reset(['search', 'statusFilter', 'periodFilter', 'startDate', 'endDate']);
    }

    public function getFacturesProperty()
    {
        $entreprise = auth('entreprise')->user();

        $query = Facture::where('entreprise_id', $entreprise->id)
            ->with(['vehicule', 'entretien.contrat'])
            ->latest('date_emission');

        // Recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('ref', 'like', '%' . $this->search . '%')
                  ->orWhere('libelle', 'like', '%' . $this->search . '%')
                  ->orWhere('name_customer', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre statut
        if ($this->statusFilter) {
            $query->where('status_paiement', $this->statusFilter);
        }

        // Filtre période
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date_emission', [$this->startDate, $this->endDate]);
        }

        return $query->paginate(10);
    }

    public function getPaiementsProperty()
    {
        $entreprise = auth('entreprise')->user();

        $query = Paiement::whereHas('reservation', function($q) use ($entreprise) {
                $q->where('entreprise_id', $entreprise->id);
            })
            ->orWhereHasMorph('payable', [Facture::class], function($q) use ($entreprise) {
                $q->where('entreprise_id', $entreprise->id);
            })
            ->with(['user', 'reservation'])
            ->latest();

        // Recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('reference', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('username', 'like', '%' . $this->search . '%')
                                ->orWhere('phone', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Filtre statut
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        // Filtre période
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        return $query->paginate(10);
    }

    public function getStatsFacturesProperty()
    {
        $entreprise = auth('entreprise')->user();

        $total = Facture::where('entreprise_id', $entreprise->id)->sum('montant_ttc');
        $paye = Facture::where('entreprise_id', $entreprise->id)
            ->where('status_paiement', 'PAID')->sum('montant_ttc');
        $attente = Facture::where('entreprise_id', $entreprise->id)
            ->where('status_paiement', 'PENDING')->sum('montant_ttc');
        $retard = Facture::where('entreprise_id', $entreprise->id)
            ->where('status_paiement', 'OVERDUE')->sum('montant_ttc');

        return [
            'total' => $total,
            'paye' => $paye,
            'attente' => $attente,
            'retard' => $retard,
            'ce_mois' => Facture::where('entreprise_id', $entreprise->id)
                ->whereMonth('date_emission', now()->month)
                ->whereYear('date_emission', now()->year)
                ->sum('montant_ttc'),
        ];
    }

    public function getStatsPaiementsProperty()
    {
        $entreprise = auth('entreprise')->user();

        $total = Paiement::whereHas('reservation', function($q) use ($entreprise) {
            $q->where('entreprise_id', $entreprise->id);
        })->sum('montant');

        $paye = Paiement::whereHas('reservation', function($q) use ($entreprise) {
            $q->where('entreprise_id', $entreprise->id);
        })->where('status', Paiement::PAID)->sum('montant');

        $attente = Paiement::whereHas('reservation', function($q) use ($entreprise) {
            $q->where('entreprise_id', $entreprise->id);
        })->where('status', Paiement::PENDING)->sum('montant');

        return [
            'total' => $total,
            'paye' => $paye,
            'attente' => $attente,
            'ce_mois' => Paiement::whereHas('reservation', function($q) use ($entreprise) {
                $q->where('entreprise_id', $entreprise->id);
            })->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year)
              ->sum('montant'),
        ];
    }

    public function openDetailsFacture($factureId)
    {
        $this->selectedItem = Facture::with(['vehicule', 'entretien.contrat', 'contrat'])
            ->findOrFail($factureId);
        $this->showDetailsModal = true;
    }

    public function openDetailsPaiement($paiementId)
    {
        $this->selectedItem = Paiement::with(['entreprise', 'reservation'])
            ->findOrFail($paiementId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedItem = null;
    }

    public function openPaiementModal($factureId)
    {
        $this->selectedFacture = Facture::findOrFail($factureId);
        $this->montant_paiement = $this->selectedFacture->montant_ttc;
        $this->showPaiementModal = true;
    }

    public function closePaiementModal()
    {
        $this->showPaiementModal = false;
        $this->selectedFacture = null;
        $this->reset(['montant_paiement', 'moyen_paiement', 'reference_paiement', 'note_paiement']);
    }

    public function effectuerPaiement()
    {
        $this->contact_paiement = $this->contact_paiement ??  auth('entreprise')->user()->phone;

        if(!$this->contact_paiement){
            return $this->send_event_at_toast('Le contact pour le paiement est requis', 'error', 'top-end'); 
        }

        $prefix = "+225";
        if (strpos($this->contact_paiement, $prefix) === 0) {
            $this->contact_paiement = substr($this->contact_paiement, strlen($prefix));
        }



        $this->validate([
            'moyen_paiement' => 'required|in:VIREMENT,CHEQUE,ESPECES,CARTE,MOBILE_MONEY',
            'reference_paiement' => 'nullable|string|max:255',
            'note_paiement' => 'nullable|string|max:500',
        ], [
            'montant_paiement.required' => 'Le montant est requis',
            'montant_paiement.min' => 'Le montant doit être positif',
            'moyen_paiement.required' => 'Veuillez sélectionner un moyen de paiement',
        ]);

        try {
            DB::beginTransaction();

            // Créer le paiement
            $paiement = Paiement::create([
                'model_id' => $this->selectedFacture->id,
                'model_type' => Facture::class,
                'entreprise_id' =>  auth('entreprise')->user()->id,
                'montant' => $this->selectedFacture->montant_ttc,
                'methode' => $this->moyen_paiement,
                'reference' => $this->reference_paiement ?: Paiement::generateUniqueReference(),
                'status' => Paiement::PENDING,
                'slug' => \Str::random(50),
            ]);

            DB::commit();

            if($this->moyen_paiement == Facture::ESPECES) {
                $this->selectedFacture->update([
                    'moyen_paiement' => Facture::ESPECES,
                    'reference_paiement' => $paiement->reference,
                ]);
            }else{
                $url_payment = PaymentService::storepaimentFacture($paiement->id, $this->contact_paiement);
                return redirect()->to($url_payment);
            }

            // Mettre à jour la facture
            // $this->selectedFacture->update([
            //     'status_paiement' => 'PAID',
            //     'moyen_paiement' => $this->moyen_paiement,
            //     'reference_paiement' => $paiement->reference,
            // ]);


            $this->closePaiementModal();
            $this->send_event_at_toast('Paiement effectué avec succès', 'success', 'top-end');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            $this->send_event_at_toast('Erreur lors du paiement: ' . $e->getMessage(), 'error', 'top-end');
        }
    }

    public function downloadFacture($factureId)
    {
        // TODO: Implémenter la génération PDF
        $this->send_event_at_toast('Génération du PDF en cours...', 'info', 'top-end');
    }

    public function exportRapport()
    {
        // TODO: Implémenter l'export
        $this->send_event_at_toast('Export en cours...', 'info', 'top-end');
    }




    //GRAPHS


    public function getDepensesChartDataProperty()
    {
        $entreprise = auth('entreprise')->user();
        $months = $this->chartPeriod === 'year' ? 12 : (int)$this->chartPeriod;

        $data = [];
        $labels = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');

            $montant = Facture::where('entreprise_id', $entreprise->id)
                ->whereMonth('date_emission', $date->month)
                ->whereYear('date_emission', $date->year)
                ->sum('montant_ttc');

            $data[] = $montant;
        }

        return [
            'labels' => $labels,
            'values' => $data
        ];
    }

    public function getRepartitionChartDataProperty()
    {
        $entreprise = auth('entreprise')->user();

        $repartition = Facture::where('entreprise_id', $entreprise->id)
            ->where('status_paiement', 'PAID')
            ->selectRaw('type, SUM(montant_ttc) as total')
            ->groupBy('type')
            ->get();

        $colors = ['#3b82f6', '#22c55e', '#f59e0b', '#a855f7'];

        return [
            'labels' => $repartition->pluck('type')->toArray(),
            'values' => $repartition->pluck('total')->toArray(),
            'colors' => array_slice($colors, 0, $repartition->count())
        ];
    }

    public function getRepartitionDataProperty()
    {
        $entreprise = auth('entreprise')->user();
        $total = Facture::where('entreprise_id', $entreprise->id)
            ->where('status_paiement', 'PAID')
            ->sum('montant_ttc');

        $repartition = Facture::where('entreprise_id', $entreprise->id)
            ->where('status_paiement', 'PAID')
            ->selectRaw('type, SUM(montant_ttc) as total')
            ->groupBy('type')
            ->get();

        $colors = ['#3b82f6', '#22c55e', '#f59e0b', '#a855f7'];

        return $repartition->map(function($item, $index) use ($total, $colors) {
            return [
                'label' => $item->type ?? 'Autre',
                'percentage' => $total > 0 ? round(($item->total / $total) * 100, 1) : 0,
                'color' => $colors[$index] ?? '#64748b'
            ];
        })->toArray();

    }

    public function updatedChartPeriod()
    {
        $this->dispatch('updateCharts', [
            'depenses' => $this->depensesChartData,
            'repartition' => $this->repartitionChartData
        ]);
    }

    public function render()
    {
        $data = [
            'activeTab' => $this->activeTab,
        ];

        if ($this->activeTab === 'factures') {
            $data['factures'] = $this->factures;
            $data['stats'] = $this->statsFactures;
        } else {
            $data['paiements'] = $this->paiements;
            $data['stats'] = $this->statsPaiements;
        }

        return view('livewire.entreprise.reports.reports-entreprise', $data);
    }
}
