<?php

namespace App\Livewire\Dashboard\Paiement;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Paiement;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PaiementsExport;
use App\Livewire\UtilsSweetAlert;
use Maatwebsite\Excel\Facades\Excel;


class Allpaiement extends Component
{
    use UtilsSweetAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $all_payment, $paid_payment, $pending_payment, $canceled_payment ;

    public $search = '';
    public $status = '';
    public $methode = '';
    public $date_from;
    public $date_to;


    public function getMontantPaymentByStatus()  {
        $this->all_payment = Paiement::sum('montant');
        $this->paid_payment = Paiement::where('status', Paiement::PAID)->sum('montant');
        $this->pending_payment = Paiement::where('status', Paiement::PENDING)->OrWhere('status', Paiement::INITIATED)->sum('montant');
        $this->canceled_payment = Paiement::where('status', Paiement::CANCELED)->sum('montant');
    }

    public function getPaiementsEtCommandes()
    {
        $paiements = Paiement::select('id','reference','user_id','montant', 'methode as methode_payment', 'status', 'created_at');

        return $paiements->orderBy('created_at', 'desc');
    }

    public function applyFilters()
    {
        $query = Paiement::query();

        if($this->search) {
            $query->where(function($q){
                $q->where('reference', 'like', '%'.$this->search.'%')
                ->orWhereHas('user', function($q){
                    $q->where('username', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%');
                });
            });
        }

        if($this->status && $this->status != 'all'){
            $query->where('status', $this->status);
        }

        if($this->methode){
            $query->where('methode', $this->methode);
        }

        if($this->date_from && $this->date_to){
            $query->whereBetween('created_at', [$this->date_from, $this->date_to]);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function exportExcel()
    {
        $paiements = $this->applyFilters()->get();
        $export = Excel::download(new PaiementsExport($paiements), 'paiements.xlsx');

        $this->send_event_at_toast("Fichier Excel exporter avec success","success","top-right");

        return $export;
    }

    public function exportPdf()
    {
        $paiements = $this->applyFilters()->get();
        return $this->exportPaiementsPdf($paiements);
    }

    public function exportPaiementsPdf($paiements)
    {

         $paiements = $this->applyFilters()->get();

        $data = $paiements->map(function($paiement){
            $reservation = $paiement->reservation;

            return [
                'Reference' => $paiement->reference,
                'Client' => $paiement->user->username ?? '',
                'Contact' => $paiement->user->phone ?? '',
                'Montant' => $paiement->montant,
                'Status paiement' => $paiement->status,
                'Methode' => $paiement->methode,
                'Date paiement' => $paiement->created_at->format('d/m/Y H:i'),
                'Montant reservation' => $reservation->montant ?? '',
                'Adresse' => $reservation->adresse_name ?? '',
                'Date début' => optional($reservation->date_debut)->format('d/m/Y'),
                'Date fin' => optional($reservation->date_fin)->format('d/m/Y'),
                'Chassis' => $reservation->chassis ?? '',
                'Service' => $reservation->snapshot_services['name'] ?? '',
                'Prestataire' => $reservation->name_prestataire ?? '',
            ];
        });


        $pdf = Pdf::loadView('exports.paiements_pdf', ['paiements' => $data])
                ->setPaper('a4', 'landscape')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'DejaVu Sans'
                ]);

        // Stream PDF pour éviter les erreurs UTF-8
        $export = response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream(); // envoie le PDF directement au navigateur
        }, 'paiements.pdf');


        $this->send_event_at_toast("Fichier PDF exporter avec success","success","top-right");
        return $export;

    }

    public function exportPaiementUniquePdf($paiement_id)
    {
        $paiement = Paiement::with('reservation', 'user')->findOrFail($paiement_id);

        $reservation = $paiement->reservation;
        $data = [
            'Reference' => $paiement->reference,
            'Client' => $paiement->user->username ?? '',
            'Contact' => $paiement->user->phone ?? '',
            'Montant' => $paiement->montant,
            'Status paiement' => $paiement->status,
            'Methode' => $paiement->methode,
            'Date paiement' => $paiement->created_at->format('d/m/Y H:i'),

            // Champs Reservation
            'Montant reservation' => $reservation->montant ?? '',
            'Adresse' => $reservation->adresse_name ?? '',
            'Date début' => optional($reservation->date_debut)->format('d/m/Y'),
            'Date fin' => optional($reservation->date_fin)->format('d/m/Y'),
            'Chassis' => $reservation->chassis ?? '',
            'Service' => $reservation->snapshot_services['name'] ?? '',
            'Prestataire' => $reservation->name_prestataire ?? '',
        ];

        $pdf = Pdf::loadView('exports.paiement_unique_pdf', ['paiement' => $data]);
        $export = response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'paiement.'.$paiement->reference.'.pdf');

        $this->send_event_at_toast("Fichier PDF du paiement exporter avec success","success","top-right");
        return $export;
    }


    public function render()
    {
        $this->getMontantPaymentByStatus();
        return view('livewire.dashboard.paiement.allpaiement',[
            'list_paiements' => $this->applyFilters()->paginate(10)
        ]);
    }
}
