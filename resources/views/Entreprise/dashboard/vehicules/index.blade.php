
@extends('Entreprise.layouts.dashboard')


@section('title', 'Véhicules')
@section('breadcrumb', 'Véhicules')


@section('content')
<div class="space-y-6" data-dashboard-view="vehicles">


    <!-- Liste dynamique Livewire -->
    @livewire('entreprise.vehicules.vehicules-list')
</div>
@endsection


@push('styles')

<style>
    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .view-toggle.active {
        background-color: rgba(59, 130, 246, 0.8);
        color: white;
    }

    .view-toggle:not(.active) {
        color: rgb(148, 163, 184);
    }

    .view-toggle:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .card-vehicle {
        transition: all 0.3s ease;
        min-height: 500px;
        display: flex;
        flex-direction: column;
        padding: 0.5rem;
    }

    .card-vehicle:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .vehicle-360 {
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .vehicle-360:hover {
        background: linear-gradient(135deg,
            rgba(59, 130, 246, 0.1) 0%,
            rgba(59, 130, 246, 0.05) 100%);
    }

    .vehicle-360 img {
        transition: transform 0.3s ease;
    }

    .vehicle-360:hover img {
        transform: scale(1.05);
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
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

    /* Mobile responsive */
    @media (max-width: 768px) {
        .vehicles-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .card-vehicle {
            min-height: auto;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 640px) {
        .dashboard-main {
            padding: 1rem;
            padding-bottom: 6rem;
        }

        .card {
            padding: 1rem;
        }

        .card-vehicle {
            padding: 1rem;
        }
    }

    @media (max-width: 768px) {
        .fixed.inset-0 {
            z-index: 60; /* Plus élevé que la nav mobile */
        }

        body.modal-open {
            overflow: hidden; /* Empêche le scroll quand modal ouverte */
        }
    }
</style>

@endpush

