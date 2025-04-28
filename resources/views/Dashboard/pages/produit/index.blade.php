@extends('Dashboard.layouts.app')

@push('title')
    Produits
@endpush

@section('content')

<livewire:dashboard.produit.allproduit />

@endsection
