<?php


namespace App\Services;

use App\Models\Offer;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Customer;
use App\Models\User;
use App\Models\Paiement;
use App\Models\Commande;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use App\Utils\CustomerNotificationUtils;


class PaymentService {


    static public function store($commande_id)
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


        $commande = Commande::find($commande_id);

        $paiement = new Paiement();
        $paiement->reference = Paiement::generateUniqueReference();
        $paiement->montant = $commande->montant;
        $paiement->commande_id = $commande_id;
        $paiement->status = Paiement::INITIATED;
        $paiement->user_name = auth()->user()->name;
        $paiement->user_phone = auth()->user()->phone;
        $paiement->user_photo_url = auth()->user()->photo_url;
        $paiement->user_id = auth()->user()->id;
        $paiement->slug = generateSlug('Paiement',$paiement->ref);
        $paiement->save();


        $client = new Client();
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json', // Ajout du Content-Type
            'Authorization' => 'Bearer ' . $token
        ];

        $body = [
            "amount"=> intval($commande->montant), //$paiement->montant
            "currency_code"=>"XOF",
            "merchant_trans_id"=> $paiement->reference,
            "seller_username"=>"Alphakb",
            "payment_type"=>"gateway",
            "designation"=> "Paiement de commande ".$paiement->commande->reference,
            "webhook_url"=> "https://twinshair-ci.com/api/webhook/adjeminpay",
            "return_url"=> "https://twinshair-ci.com/return_payment_url/twinshair",
            "cancel_url"=> "https://twinshair-ci.com/",
            "customer_recipient_number"=> auth()->user()->phone_number,
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

    public function createPayment($commande_id)  {

        $commande = Commande::find($commande_id);

        $paiement = new Paiement();
        $paiement->ref = Paiement::generateUniqueReference();
        $paiement->montant = $commande->prix;
        $paiement->taxes =  0;
        $paiement->prix_initiale = $commande->prix;
        $paiement->commande_id = $commande_id;
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
        $commande = Commande::where('id',$paiement->commande_id)->first();
        if(!$commande) {
            return 'commande introuvable';
        }



        switch ($status) {
            case Paiement::SUCCESSFUL:
                    $this->validatecommande($commande);

                    $paiement->status = Paiement::SUCCESSFUL;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();

                break;
            case Paiement::CANCELED:
                    $this->Cancelcommande($commande);

                    $paiement->status = Paiement::CANCELED;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();

                break;
            case Paiement::FAILED:
                $this->Cancelcommande($commande);

                    $paiement->status = Paiement::FAILED;
                    $paiement->methode = $request->payment_method ?? "Wave_ci";
                    $paiement->is_completed = true;
                    $paiement->save();
                break;
            case Paiement::EXPIRED:
                $this->Cancelcommande($commande);

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


    function validatecommande($commande) {
        $offer = Offer::where('id',$commande->offer_id)->first();
        $last_commande = Commande::where('id','!=',$commande->id)->where('customers','like','%'.json_decode($commande->customers)[0].'%')->where('offer_id',$commande->offer_id)->orderBy('id','desc')->first();


        if($last_commande) {
            if(Carbon::parse($last_commande->date_fin) >= now() && $last_commande->status == Commande::ACTIF) {
                $todays =Carbon::createFromDate(now());
                $old_date_debut = Carbon::createFromDate($last_commande->date_debut);
                $old_date_fin = Carbon::createFromDate($last_commande->date_fin);
                $diff_days = intval($todays->diffInDays($old_date_fin));
                $new_nb_jour = $diff_days + $offer->nb_jours;


                $last_commande->status = Commande::INACTIF;
                $last_commande->save();

                $commande->status = Commande::ACTIF;
                $commande->date_debut = Carbon::now();
                $commande->is_paid = true;
                $commande->date_fin = Carbon::now()->addDays($new_nb_jour);
                $commande->save();
            }else{
                $commande->status = Commande::ACTIF;
                $commande->date_debut = Carbon::now();
                $commande->is_paid = true;
                $commande->date_fin = Carbon::now()->addDays($offer->nb_jours);
                $commande->save();
            }
        }else{
            $commande->status = Commande::ACTIF;
            $commande->is_paid = true;
            $commande->date_debut = Carbon::now();
            $commande->date_fin = Carbon::now()->addDays($offer->nb_jours);
            $commande->save();
        }

        $customer_send = Customer::where('id',json_decode($commande->customers)[0])->first();
        $this->sendNotificationToCustomer($customer_send,"commande validé",'Le paiement de votre commande a été confirmé avec succès.', $offer);
    }

    function Cancelcommande($commande)  {
        $commande->status = Commande::NOT_PAID;
        $commande->is_paid = false;
        $commande->save();
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
