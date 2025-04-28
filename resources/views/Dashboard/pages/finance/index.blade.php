@extends('Dashboard.layouts.app')

@push('title')
    Etats financiers
@endpush

@section('content')

<livewire:dashboard.finance.allfinance />

@endsection
