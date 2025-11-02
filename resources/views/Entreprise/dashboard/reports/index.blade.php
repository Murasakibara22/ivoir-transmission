{{-- resources/views/Entreprise/reports/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')

@section('title', 'Rapports & Paiements')
@section('breadcrumb', 'Rapports')

@section('content')

<div class="space-y-6" data-dashboard-view="reports">

    @livewire('entreprise.reports.reports-entreprise')

</div>

@endsection
