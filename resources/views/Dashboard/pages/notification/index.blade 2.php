@extends('Dashboard.layouts.app')

@push('title')
    Notifications
@endpush

@section('content')
    <livewire:dashboard.notification.allnotification />
@endsection
