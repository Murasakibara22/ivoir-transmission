@extends('Dashboard.layouts.app')

@push('title')
    Réservations
@endpush

@section('content')

    <livewire:dashboard.reservation.allreservation />

@endsection
