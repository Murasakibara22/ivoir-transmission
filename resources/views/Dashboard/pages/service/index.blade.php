@extends('Dashboard.layouts.app')

@push('title')
    Services
@endpush

@section('content')

<livewire:dashboard.service.allservice />

@endsection
