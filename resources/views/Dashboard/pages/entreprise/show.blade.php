@extends('Dashboard.layouts.app')


@push('title')
    Entreprise
@endpush

@section('content')

    <livewire:dashboard.entreprise.manage-entreprise :entrepriseId="$entreprise->id" />

@endsection
