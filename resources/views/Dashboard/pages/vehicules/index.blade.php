@extends('Dashboard.layouts.app')


@push('title')
    Vehicules
@endpush

@section('content')

    <livewire:dashboard.vehicules.all-vehicules />

@endsection
