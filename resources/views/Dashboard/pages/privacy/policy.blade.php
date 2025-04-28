@extends('Dashboard.layouts.app')

@push('title')
    Politique de confidentialité
@endpush

@section('content')

<livewire:dashboard.policy.allpolicy />

@endsection
