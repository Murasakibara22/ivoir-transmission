<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{


    public function webhookFunc(Request $request)
    {
        $transaction_reference = $request->get('transaction_id');
        $status = $request->get('status');

        if (empty($transaction_reference)) {
            return response()->json([
                'error' => [
                    'message' => "Transaction not found",
                    'transaction_reference' => $transaction_reference
                ],
            ]);
        }



        $paiement = Paiement::where('reference',$transaction_reference)->first();
        $reservation = Reservation::where('id',$paiement->reservation_id)->first();
        if(!$reservation) {
            return 'reservation introuvable';
        }

        if(empty($paiement)) {
            return response()->json([
                'error' => [
                    'message' => "Paiement not found",
                    'transaction_reference' => $transaction_reference
                ],
            ]);
        }


        switch ($status) {
            case 'SUCCESSFUL':
                    $this->validatereservation($reservation);

                    $paiement->status = "PAYE";
                    $paiement->methode = $request->payment_gateway_payment_method ?? "Wave_ci";
                    $paiement->save();

                break;
            case "CANCELED":
                    $this->Cancelreservation($reservation);

                    $paiement->status = "ANNULER";
                    $paiement->methode = $request->payment_gateway_payment_method ?? "Wave_ci";
                    $paiement->save();

                break;
            case "FAILED":
                $this->Cancelreservation($reservation);

                    $paiement->status = "FAILED";
                    $paiement->methode = $request->payment_gateway_payment_method ?? "Wave_ci";
                    $paiement->save();
                break;
            case "EXPIRED":
                $this->Cancelreservation($reservation);

                    $paiement->status = "EXPIRED";
                    $paiement->methode = $request->payment_gateway_payment_method ?? "Wave_ci";
                    $paiement->save();

                break;
            case "INITIATED":
                $this->initiatedStatusreservation($reservation);

                    $paiement->status = "INITIATED";
                    $paiement->methode = $request->payment_gateway_payment_method ?? "Wave_ci";
                    $paiement->save();

                break;

            default:
                return  'MISSING_TRANSACTION_STATUS';
                break;
        }

        return $paiement;
    }




    function validatereservation($reservation) {
        $reservation = Reservation::find($reservation->id);

        // $reservation->status = Reservation::VALIDATE;
        $reservation->status_paiement = Reservation::SUCCESSFUL;
        $reservation->save();
    }

    function Cancelreservation($reservation)  {
        $reservation->status_paiement = Reservation::NOT_PAID;
        $reservation->save();
    }

    function initiatedStatusreservation($reservation) {
        $reservation->status_paiement = Reservation::INITIATED;
        $reservation->save();
    }
}
