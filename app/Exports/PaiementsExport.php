<?php

namespace App\Exports;

use App\Models\Paiement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaiementsExport implements FromCollection, WithHeadings
{
     protected $paiements;

    public function __construct($paiements)
    {
        $this->paiements = $paiements;
    }

    public function collection()
    {
        return $this->paiements->map(function($paiement){
            $reservation = $paiement->reservation;

            return [
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
        });
    }

    public function headings(): array
    {
        return [
            'Reference',
            'Client',
            'Contact',
            'Montant',
            'Status paiement',
            'Methode',
            'Date paiement',
            'Montant reservation',
            'Adresse',
            'Date début',
            'Date fin',
            'Chassis',
            'Service',
            'Prestataire'
        ];
    }
}
