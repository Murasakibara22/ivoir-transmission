@extends('Dashboard.layouts.app')

@push('title')
    Produits détails {{ $produit->libelle }}
@endpush

@section('content')

<livewire:dashboard.produit.showproduit :produit="$produit" />

@endsection
