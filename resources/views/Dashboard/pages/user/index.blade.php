@extends('Dashboard.layouts.app')

@push('title')
    Utilisateurs
@endpush

@section('content')

<livewire:dashboard.user.alluser />

@endsection
