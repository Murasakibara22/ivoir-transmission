@extends('Dashboard.layouts.app')

@push('title')
    Utilisateurs {{$user->username}}
@endpush

@section('content')

<livewire:dashboard.user.showuser  :user="$user" />

@endsection
