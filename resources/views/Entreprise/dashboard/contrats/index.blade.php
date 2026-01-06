{{-- resources/views/dashboard/rapports/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')

@section('title', 'Contrats')
@section('breadcrumb', 'Contrats')

@section('content')

<div class="space-y-6" data-dashboard-view="contrats">

    @livewire('entreprise.contrats.contrats-entreprise')

</div>


@endsection
