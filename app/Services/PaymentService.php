<?php


namespace App\Services;

use App\Models\Offer;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Customer;
use App\Models\User;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use App\Utils\CustomerNotificationUtils;


class PaymentService {


    static public function store($reservation_id, $contact)
    {

        $clientAuth = new Client();
        $options = [
            'form_params' => [
            'client_id' => Paiement::CLIENID,
            'client_secret' => Paiement::CLIENSECRET,
            'grant_type' => 'client_credentials'
        ]];
        $response = $clientAuth->request('POST', 'https://api.adjem.in/v3/oauth/token',$options);

        $token = json_decode($response->getBody())->access_token;

        // dd($token);


        $reservation = Reservation::find($reservation_id);

        $paiement = new Paiement();
        $paiement->reference = Paiement::generateUniqueReference();
        $paiement->montant = $reservation->montant;
        $paiement->reservation_id = $reservation_id;
        $paiement->status = Paiement::INITIATED;
        $paiement->user_id = auth()->user()->id;
        $paiement->snapshot_users = json_encode([
            'id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'phone' => auth()->user()->phone,
        ]);
        $paiement->snapshot_reservation = json_encode([
            'id' => $reservation->id,
            'montant' => $reservation->montant,
            'status' => $reservation->status,
            'adresse_name' => $reservation->adresse_name,
            'location' => $reservation->location,
            'date_debut' => $reservation->date_debut,
            'date_fin' => $reservation->date_fin,
            'slug' => $reservation->slug,
        ]);
        $paiement->slug = generateSlug('Paiement',$paiement->ref);
        $paiement->save();


        $client = new Client();
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json', // Ajout du Content-Type
            'Authorization' => 'Bearer ' . $token
        ];

        $body = [
            "amount"=> intval($reservation->montant), //$paiement->montant
            "currency_code"=>"XOF",
            "merchant_trans_id"=> $paiement->reference,
            "seller_username"=>"Alphakb",
            "payment_type"=>"gateway",
            "designation"=> "Paiement de reservation ".$paiement->reservation->reference,
            "webhook_url"=> "http://127.0.0.1:9000/api/webhook/adjeminpay",
            "return_url"=> "http://127.0.0.1:9000/success-transaction",
            "cancel_url"=> "http://127.0.0.1:9000/",
            "customer_recipient_number"=> $contact,
            "customer_email"=> auth()->user()->email ?? "",
            "customer_firstname"=>auth()->user()->username,
            "customer_lastname"=>auth()->user()->username
        ];
        // return response()->json($body);


        $response = Http::withHeaders($headers)->post('https://api.adjem.in/v3/gateway/merchants/create_payment',$body);


        return $response['data']['gateway_payment_url'];

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function AuthenticatePayment()  {
        $client = new Client();
        $options = [
            'form_params' => [
            'client_id' => Paiement::CLIENID,
            'client_secret' => Paiement::CLIENSECRET,
            'grant_type' => 'client_credentials'
        ]];
        $response = $client->request('POST', 'https://api.adjem.in/v3/oauth/token',$options);

       return json_decode($response->getBody())->access_token;
    }

    public function createPayment($reservation_id)  {

        $reservation = Reservation::find($reservation_id);

        $paiement = new Paiement();
        $paiement->ref = Paiement::generateUniqueReference();
        $paiement->montant = $reservation->prix;
        $paiement->taxes =  0;
        $paiement->prix_initiale = $reservation->prix;
        $paiement->reservation_id = $reservation_id;
        $paiement->currency_code = "XOF";
        $paiement->status = Paiement::PENDING;
        $paiement->customer_name = auth('api')->user()->name;
        $paiement->customer_phone = auth('api')->user()->phone;
        $paiement->customer_id = auth('api')->user()->id;
        $paiement->slug = generateSlug('Paiement',$paiement->ref);
        $paiement->save();

        return $paiement;
    }

    public function webhookFunc(Request $request)
    {
        $request->validate([
            'merchant_trans_id' => 'required|exists:paiements,ref',
            'status' => 'required'
        ]);

        $transaction_reference = $request->get('merchant_trans_id');
        $status = $request->get('status');


        $paiement = Paiement::where('ref',$transaction_reference)->first();
        $reservation = Reservation::where('id',$paiement->reservation_id)->first();
        if(!$reservation) {
            return 'reservation introuvable';
        }



        switch ($status) {
            case Paiement::SUCCESSFUL:
                    $this->validatereservation($reservation);

                    $paiement->status = Paiement::SUCCESSFUL;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();

                break;
            case Paiement::CANCELED:
                    $this->Cancelreservation($reservation);

                    $paiement->status = Paiement::CANCELED;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();

                break;
            case Paiement::FAILED:
                $this->Cancelreservation($reservation);

                    $paiement->status = Paiement::FAILED;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();
                break;
            case Paiement::EXPIRED:
                $this->Cancelreservation($reservation);

                    $paiement->status = Paiement::EXPIRED;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();

                break;

            default:
                return  'MISSING_TRANSACTION_STATUS';
                break;
        }

        return $paiement;
    }


    function validatereservation($reservation) {
        $offer = Offer::where('id',$reservation->offer_id)->first();
        $last_reservation = Reservation::where('id','!=',$reservation->id)->where('customers','like','%'.json_decode($reservation->customers)[0].'%')->where('offer_id',$reservation->offer_id)->orderBy('id','desc')->first();


        if($last_reservation) {
            if(Carbon::parse($last_reservation->date_fin) >= now() && $last_reservation->status == Reservation::ACTIF) {
                $todays =Carbon::createFromDate(now());
                $old_date_debut = Carbon::createFromDate($last_reservation->date_debut);
                $old_date_fin = Carbon::createFromDate($last_reservation->date_fin);
                $diff_days = intval($todays->diffInDays($old_date_fin));
                $new_nb_jour = $diff_days + $offer->nb_jours;


                $last_reservation->status = Reservation::INACTIF;
                $last_reservation->save();

                $reservation->status = Reservation::ACTIF;
                $reservation->date_debut = Carbon::now();
                $reservation->is_paid = true;
                $reservation->date_fin = Carbon::now()->addDays($new_nb_jour);
                $reservation->save();
            }else{
                $reservation->status = Reservation::ACTIF;
                $reservation->date_debut = Carbon::now();
                $reservation->is_paid = true;
                $reservation->date_fin = Carbon::now()->addDays($offer->nb_jours);
                $reservation->save();
            }
        }else{
            $reservation->status = Reservation::ACTIF;
            $reservation->is_paid = true;
            $reservation->date_debut = Carbon::now();
            $reservation->date_fin = Carbon::now()->addDays($offer->nb_jours);
            $reservation->save();
        }

        $customer_send = Customer::where('id',json_decode($reservation->customers)[0])->first();
        $this->sendNotificationToCustomer($customer_send,"reservation validé",'Le paiement de votre reservation a été confirmé avec succès.', $offer);
    }

    function Cancelreservation($reservation)  {
        $reservation->status = Reservation::NOT_PAID;
        $reservation->is_paid = false;
        $reservation->save();
    }





    private function sendNotificationToCustomer($customer,$title,$subtitle, $offer) {
                $notification = Notification::create([
                    'customer_id' => $customer->id,
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'meta_data_id' => $offer->id,
                    'is_read' => false,
                    'is_received' => false,
                    'type' => $offer->table,
                ]);

                CustomerNotificationUtils::notify($notification);
    }


}
