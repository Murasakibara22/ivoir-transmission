@extends('Dashboard.layouts.app')

@push('title')
    Paiements details {{ $paiement->reference }}
@endpush

@section('content')

<livewire:dashboard.paiement.showpaiement :paiement="$paiement" />

@endsection
