@extends('Dashboard.layouts.app')

@push('title')
    Commandes
@endpush

@section('content')

    <livewire:dashboard.commande.allcommande />

@endsection
