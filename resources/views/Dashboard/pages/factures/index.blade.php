@extends('Dashboard.layouts.app')


@push('title')
    Factures
@endpush

@section('content')

    <livewire:dashboard.factures.all-factures />

@endsection
