{{-- resources/views/dashboard/planning/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')


@section('title', 'Planning')
@section('breadcrumb', 'Planning')

@section('content')
<div class="space-y-6" data-dashboard-view="planning">
    @livewire('entreprise.planning.planning-entreprise')
</div>

@endsection


@push('styles')
<style>
    /* Calendar Styles */
    .calendar-wrapper {
        background: rgba(30, 41, 59, 0.3);
        border-radius: 1rem;
        padding: 1.5rem;
    }

    .calendar-header {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .calendar-day-name {
        text-align: center;
        font-weight: 600;
        color: rgb(148, 163, 184);
        font-size: 0.875rem;
        padding: 0.5rem;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
    }

    .calendar-day {
        min-height: 120px;
        background: rgba(51, 65, 85, 0.3);
        border: 1px solid rgba(71, 85, 105, 0.3);
        border-radius: 0.75rem;
        padding: 0.75rem;
        transition: all 0.2s ease;
    }

    .calendar-day:hover {
        background: rgba(51, 65, 85, 0.5);
        border-color: rgba(71, 85, 105, 0.5);
    }

    .calendar-day.other-month {
        opacity: 0.3;
    }

    .calendar-day.today {
        background: rgba(59, 130, 246, 0.1);
        border-color: rgba(59, 130, 246, 0.5);
    }

    .day-number {
        font-weight: 600;
        color: white;
        font-size: 0.875rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .calendar-event {
        background: rgba(59, 130, 246, 0.2);
        border-left: 3px solid rgb(59, 130, 246);
        padding: 0.5rem;
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .calendar-event:hover {
        background: rgba(59, 130, 246, 0.3);
        transform: translateX(2px);
    }

    .calendar-event.event-urgent {
        background: rgba(239, 68, 68, 0.2);
        border-left-color: rgb(239, 68, 68);
    }

    .calendar-event.event-attente {
        background: rgba(245, 158, 11, 0.2);
        border-left-color: rgb(245, 158, 11);
    }

    .calendar-event.event-confirme {
        background: rgba(34, 197, 94, 0.2);
        border-left-color: rgb(34, 197, 94);
    }

    .event-time {
        font-size: 0.75rem;
        color: rgb(148, 163, 184);
        margin-bottom: 0.25rem;
    }

    .event-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .view-toggle.active {
        background-color: rgba(59, 130, 246, 0.8);
        color: white;
    }

    .view-toggle:not(.active) {
        color: rgb(148, 163, 184);
    }

    .stat-card {
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid;
        background-color: rgba(30, 41, 59, 0.5);
    }

    .stat-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .status-urgent {
        background-color: rgba(239, 68, 68, 0.1);
        color: rgb(248, 113, 113);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: rgb(251, 191, 36);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-success {
        background-color: rgba(34, 197, 94, 0.1);
        color: rgb(74, 222, 128);
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    @media (max-width: 768px) {
        .calendar-day {
            min-height: 80px;
            padding: 0.5rem;
        }
    }
</style>
@endpush
