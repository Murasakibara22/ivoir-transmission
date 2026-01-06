{{-- resources/views/dashboard/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    @livewire('entreprise.entreprise-dashboard')
@endsection

@push('scripts')
<script>
    // Animations d'entrée pour les cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card, .card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush
