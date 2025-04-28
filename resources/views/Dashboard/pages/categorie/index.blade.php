@extends('Dashboard.layouts.app')

@push('title')
    Catégories
@endpush

@section('content')

<livewire:dashboard.categorie.allcategorie />

@endsection
