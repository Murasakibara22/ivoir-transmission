@extends('Dashboard.layouts.app')

@push('title')
    Détail Commande {{ $commande->reference}}
@endpush

@section('content')

    <livewire:dashboard.commande.showcommande :commande="$commande" />

@endsection
