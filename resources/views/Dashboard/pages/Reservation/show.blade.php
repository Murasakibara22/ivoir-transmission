@extends('Dashboard.layouts.app')

@push('title')
  Détails  Réservations {{ $reservation->reference}}
@endpush

@section('content')

    <livewire:dashboard.reservation.showreservation :reservation="$reservation" />

@endsection
