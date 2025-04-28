<?php

namespace App\Livewire\Dashboard\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Livewire\UtilsSweetAlert;

class Alluser extends Component
{

    use WithFileUploads, UtilsSweetAlert, WithPagination ;

    protected $paginationTheme = 'bootstrap';


    public $list_client ;

    #[Locked]
    public $id_client;

    public $search = '';

    public $nom,$prenom,$dial_code,$phone_number,$email,$gender, $username;

    public $list_dial_code;
    public $verify_nom,$activate_delete_client ;

    //Stats
    public $all_stats_client,$stats_client_masculin ,$stats_client_feminin, $stats_client_delete, $stats_by_month ;

    //filtrer selected
    public $filter_start_date, $filter_end_date, $filter_sexe, $filter_genre;


    public function mount() {
        $this->getStats();
    }

    protected $rules = [
        'nom' => 'required|string|min:3|max:255',
        'prenom' => 'required|string|min:3|max:255',
        'dial_code' => 'required|string|max:5',
        'phone_number' => 'required|string|max:10',
        'email' => 'required|email|max:255',
        'gender' => 'required|string|max:6',
    ];

    protected $messages = [
        'nom.required' => 'Le nom est obligatoire !!',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'nom.min' => 'Le nom doit contenir au minimum 3 caractères',
            'prenom.required' => 'Le prenom est obligatoire !!',
            'prenom.max' => 'Le prenom ne doit pas dépasser 255 caractères',
            'prenom.min' => 'Le prenom doit contenir au minimum 3 caractères',
            'dial_code.required' => 'Le code de dial est obligatoire !!',
            'dial_code.max' => 'Le code de dial ne doit pas dépasser 5 caractères',
            'phone_number.required' => 'Le numéro de téléphone est obligatoire !!',
            'phone_number.max' => 'Le numéro de téléphone ne doit pas dépasser 10 caractères',
            'email.required' => 'L\'email est obligatoire !!',
            'email.email' => 'Ce champs doit être une adresse email valide !!',
            'email.unique' => 'Cet email existe déja !!',
            'gender.required' => 'Le genre est obligatoire !!',
            'gender.max' => 'Le genre ne doit pas dépasser 6 caractères',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editClient($id){
        $client = User::find($id);

        if(!$client){
            $this->send_event_at_toast('Client introuvable !!','error','top-right');
            return ;
        }

        $this->id_client = $id;
        $this->nom = $client->nom;
        $this->prenom = $client->prenom;
        $this->dial_code = $client->dial_code;
        $this->phone_number = $client->phone_number;
        $this->email = $client->email;
        $this->gender = $client->gender;

        $this->launch_modal('edit_client');
    }

    public function updateClient(){

        $this->validate();
        $client = User::find($this->id_client);

        if(!$client){
            $this->send_event_at_toast('Client introuvable !!','error','top-right');
            return ;
        }

        $client_exist = User::where('email', $this->email)->where('id', '!=', $this->id_client)->first();
        if($client_exist){
            // Log
            ActivityLog("Tentative de modification d'un client : ".$this->email, "Admin");

            $this->send_event_at_toast('Cet email existe déja !!','error','top-right');
            return ;
        }

        $client_exist_phone = User::where('phone_number', $this->phone_number)->where('id', '!=', $this->id_client)->first();
        if($client_exist_phone){
            // Log
            ActivityLog("Tentative de modification d'un client : ".$this->phone_number, "Admin");

            $this->send_event_at_toast('Ce numéro de téléphone existe déja !!','error','top-right');
            return ;
        }

        $nom = ucfirst(strtolower($this->nom));
        $prenom = ucfirst(strtolower($this->prenom));
        $name = $nom . ' ' . $prenom;
        $phone = $this->dial_code . $this->phone_number;
        $email = strtolower($this->email);

        $client->update([
            'nom' => $nom,
            'prenom' => $prenom,
            'name' => $name,
            'phone_number' => $this->phone_number,
            'phone' => $phone,
            'email' => $email,
            'gender' => $this->gender,
            'dial_code' => $this->dial_code,
            'slug' => 'customer-' .Str::slug(Hash::make($name),"-")
        ]);

        // Log
        ActivityLog("Modification du client : ".$client->name, "Admin");

        $this->send_event_at_sweetAlerte("suppression effectuer !!","Prestataire Supprimer avec succes","success");
        $this->closeModal_after_edit('edit_client');
        $this->reset();
        $this->list_client = User::orderBy('created_at', 'DESC')->get();
        $this->getStats();
    }

    public function deleteClient($id){

        $client = User::find($id);

        if(!$client){
            $this->send_event_at_toast('Client introuvable !!','error','top-right');
            return ;
        }

        $this->verify_nom = null ;
        $this->activate_delete_client = false ;
        $this->id_client = $client->id;
        $this->nom = $client->nom;
        $this->launch_modal('confirm_delete_client');
    }

    public function updatedVerifyNom(){
        if($this->verify_nom == $this->nom){
            $this->activate_delete_client = true;
        }else{
            $this->activate_delete_client = false;
        }
    }

    public function confirmDeleteClient(){
        $client = User::find($this->id_client);

        if(!$client){
            $this->send_event_at_toast('Client introuvable !!','error','top-right');
            return ;
        }

        $client->deleted_at = now();
        $client->update();

         // Log
         ActivityLog("Suppression du client : ".$client->name, "Admin");

        $this->send_event_at_sweetAlerte("suppression effectuer !!","Client Supprimer avec succes","success");
        $this->closeModal_after_edit('confirm_delete_client');
        $this->reset();
        $this->list_client = User::orderBy('created_at', 'DESC')->get();

        $this->getStats();
    }


    //Search and filter

    public function updatedSearch()
    {
        if($this->list_client){
            $_client = User::where('name', 'like', '%' . $this->search . '%')->Orwhere('email', 'like', '%' . $this->search . '%')->Orwhere('phone', 'like', '%' . $this->search . '%')-> orderBy('created_at', 'DESC')->get();
            $table_client = array();
            foreach ($_client as $key => $value) {
                if($value->deleted_at == null){
                    array_push($table_client, $value);
                }
            }

            $this->list_client = Collect($table_client);
        }

    }

    public function FilterByBloc($title = "all")  {

        switch ($title) {
            case 'Hommes':
                $this->list_client = User::where('gender', 'M')->orderBy('created_at', 'DESC')->get();
                break;
            case 'Femmes':
                $this->list_client = User::where('gender', 'F')->orderBy('created_at', 'DESC')->get();
                break;
            case 'Deleted':
                $this->list_client = User::orderBy('created_at', 'DESC')->get();
                break;

            default:
                $this->list_client = User::orderBy('created_at', 'DESC')->get();
                break;
        }
    }

    public function showFilter()  {
        $this->reset('filter_start_date', 'filter_end_date', 'filter_sexe', 'filter_genre');
        $this->launch_modal('filter_client');
    }

    public function validateFilter()  {
        $this->validate([
            'filter_start_date' => 'required',
            'filter_end_date' => 'required|after:filter_start_date',
        ],[
            'filter_start_date.required' => 'La date de début est obligatoire !!',
            'filter_end_date.required' => 'La date de fin est obligatoire !!',
            'filter_end_date.after' => 'La date de fin doit être postérieure à la date de début !!',
        ]);


        $customer = User::whereBetween('created_at', [$this->filter_start_date, $this->filter_end_date])
                    ->when($this->filter_sexe, function ($query) {
                        return $query->where('sexe', $this->filter_sexe);
                    })->when($this->filter_genre, function ($query) {
                        return $query->where('gender', $this->filter_genre);
                    })->orderBy('created_at', 'DESC')->get();

        $this->list_client = $customer;
        if($this->list_client->count() == 0){
            $this->send_event_at_toast('Aucun client trouvé pour le filtre éffectué !!','warning','top-right');
        }
        $this->closeModal_after_edit('filter_client');
    }

    public function ExportExcelList()  {

        if($this->list_client && $this->list_client->count() > 0) {
            $this->send_event_at_toast('Liste exportée avec succès !!','success','top-right');
            return Excel::download(new CustomersExport($this->list_client), 'customers.xlsx');
        }else{
            $this->send_event_at_toast('Liste exportée avec succès !!','success','top-right');
            return Excel::download(new CustomersExport, 'customers.xlsx');
        }


    }

    public function exportPdfList()
    {

        if($this->list_client && $this->list_client->count() > 0) {
            $data = $this->list_client->select([
                'nom',
                'prenom',
                'name',
                'dial_code',
                'phone',
                'birth_date',
                'email',
                'gender',
                'sexe',
                'evolution_thematique',
                'evolution_niveau',
                'created_at'
            ]);
        }else{
            $data = User::select([
                'nom',
                'prenom',
                'name',
                'dial_code',
                'phone',
                'birth_date',
                'email',
                'gender',
                'sexe',
                'evolution_thematique',
                'evolution_niveau',
                'created_at'
            ])->get();
        }

        $pdf = Pdf::loadView('Backend.pdf.customer.all', compact('data'));

        return   response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'customers_pdf.pdf');
    }







    //Get Stats
    protected function getStats()
    {
        $this->all_stats_client = User::count();
        $this->stats_client_masculin = User::where('gender', 'M')->count();
        $this->stats_client_feminin = User::where('gender', 'F')->count();
        $this->stats_client_delete = User::count();

        $this->getStatsByMonth();
    }

    protected function getStatsByMonth()  {
        $janvier_stat = User::whereMonth('created_at', 1)->whereYear('created_at', date('Y'))->count();
        $fevrier = User::whereMonth('created_at', 2)->whereYear('created_at', date('Y'))->count();
        $mars = User::whereMonth('created_at', 3)->whereYear('created_at', date('Y'))->count();
        $avril = User::whereMonth('created_at', 4)->whereYear('created_at', date('Y'))->count();
        $mai = User::whereMonth('created_at', 5)->whereYear('created_at', date('Y'))->count();
        $juin = User::whereMonth('created_at', 6)->whereYear('created_at', date('Y'))->count();
        $juillet = User::whereMonth('created_at', 7)->whereYear('created_at', date('Y'))->count();
        $aout = User::whereMonth('created_at', 8)->whereYear('created_at', date('Y'))->count();
        $septembre = User::whereMonth('created_at', 9)->whereYear('created_at', date('Y'))->count();
        $octobre = User::whereMonth('created_at', 10)->whereYear('created_at', date('Y'))->count();
        $novembre = User::whereMonth('created_at', 11)->whereYear('created_at', date('Y'))->count();
        $decembre = User::whereMonth('created_at', 12)->whereYear('created_at', date('Y'))->count();

        $this->stats_by_month = collect([
            'janvier' => $janvier_stat,
            'fevrier' => $fevrier,
            'mars' => $mars,
            'avril' => $avril,
            'mai' => $mai,
            'juin' => $juin,
            'juillet' => $juillet,
            'aout' => $aout,
            'septembre' => $septembre,
            'octobre' => $octobre,
            'novembre' => $novembre,
            'decembre' => $decembre
        ]);
    }



    public function render()
    {
        return view('livewire.dashboard.user.alluser',[
            'list_all_client' => User::where('username', 'like', '%' . $this->search . '%')->where('role_id',Role::where('libelle','Utilisateur')->first()->id)->orderBy('created_at', 'DESC')->paginate(16),
        ]);
    }
}
