@extends('Dashboard.layouts.app')

@push('title')
    Villes / communes
@endpush

@section('content')
    <livewire:dashboard.ville.allville/>
@endsection
