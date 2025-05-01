@extends('Frontend.layouts.app')


@section('content')

<!-- Featured Title -->
<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="wprt-container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">Rendez-vous</h1>
            </div>

            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail"><a href="#" title="Home" rel="home" class="trail-begin">Accueil</a> <span class="sep"><i class="rt-icon-right-arrow12"></i></span> <span class="trail-end">Rendez-vous</span></div>
                </div>
            </div>
        </div>
    </div>
</div><!-- #featured-title -->


<livewire:frontend.rdv.makereservation />





@endsection
