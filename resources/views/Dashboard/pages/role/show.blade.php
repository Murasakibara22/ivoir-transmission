@extends('Dashboard.layouts.app')

@push('title')
    Details Role : {{ $role->libelle }}
@endpush

@section('content')

<livewire:dashboard.role.showrole :role="$role" />

@endsection
