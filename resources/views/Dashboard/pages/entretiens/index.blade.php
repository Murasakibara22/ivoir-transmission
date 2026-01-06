@extends('Dashboard.layouts.app')


@push('title')
    Entretiens
@endpush

@section('content')

    <livewire:dashboard.entretiens.all-entretiens />

@endsection
