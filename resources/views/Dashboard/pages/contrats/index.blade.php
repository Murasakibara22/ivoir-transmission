@extends('Dashboard.layouts.app')


@push('title')
    Contrats
@endpush

@section('content')

    <livewire:dashboard.contrats.all-contrats />

@endsection
