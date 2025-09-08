<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationsExport implements FromCollection, WithHeadings
{
    protected $reservations;

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
    }

    public function collection()
    {
        return $this->reservations->map(function($reservation){
            return [
                'REF' => $reservation->reference ?? '',
                'Client' => $reservation->user->username ?? $reservation->user->phone ?? '',
                'Chassis' => $reservation->chassis ?? '',
                'A_faire_le' => optional($reservation->date_debut)->format('d/m/Y H:i'),
                'Montant' => $reservation->montant ?? 0,
                'Status_paiement' => $reservation->status_paiement ?? '',
                'Status' => $reservation->status ?? '',
                'Adresse' => $reservation->adresse_name ?? '',
                'Commune' => $reservation->commune ?? '',
                'Date_creation' => optional($reservation->created_at)->format('d/m/Y H:i'),
                'Service' => $reservation->snapshot_services['name'] ?? '',
                'Prestataire' => $reservation->name_prestataire ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'REF','Client','Chassis','A faire le','Montant','Status paiement','Status','Adresse','Commune','Date creation','Service','Prestataire'
        ];
    }
}
