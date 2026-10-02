@extends('layouts.front_end')

@section('page_content')
<section class="rr-listing-hero">
    <div class="rr-shell">
        <p class="rr-eyebrow">Find your place</p>
        <h1>Available properties</h1>
        <p>Explore homes for rent or sale and compare price, location, and features at a glance.</p>
        <div class="rr-hero-search-box">
            <form class="rr-hero-search-form" action="{{ url('our-properties') }}" method="get" role="search">
                <div class="rr-hero-search-input-wrap">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input id="property-search" type="text" name="search" aria-label="Search available homes by street name, address, or city" placeholder="Search by street name, address, or city..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="rr-hero-search-btn">
                    <span>Find Homes</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<main class="rr-shell rr-listings" aria-label="Available properties">
    <div class="rr-results-heading">
        <div>
            <p class="rr-eyebrow">Available homes</p>
            <h2>{{ $db_data['Property']->total() }} {{ Illuminate\Support\Str::plural('property', $db_data['Property']->total()) }}</h2>
        </div>
        @if(request('search'))
            <a class="rr-clear-search" href="{{ url('our-properties') }}">Clear search</a>
        @endif
    </div>

    @if($db_data['Property']->isNotEmpty())
        <div class="rr-property-grid">
            @foreach($db_data['Property'] as $Property)
                @php
                    $detailUrl = url('properties/explore-details/'.$Property->p_slug);
                    $monthlyRent = $Property->p_listing_status === 'for-rent';
                @endphp
                <article class="rr-property-card">
                    <a class="rr-card-image" href="{{ $detailUrl }}" aria-label="View {{ $Property->p_title }}">
                        <img src="{{ asset('resources/files/dynamic/'.$Property->p_banner_image) }}" alt="{{ $Property->p_title }}" loading="lazy">
                        <span class="rr-status">{{ $monthlyRent ? 'For rent' : 'For sale' }}</span>
                    </a>
                    <div class="rr-card-body">
                        <div class="rr-card-price">
                            @if(filled($Property->p_price) && (float) $Property->p_price > 0)
                                <strong>${{ number_format((float) $Property->p_price, 0) }}</strong>
                                @if($monthlyRent)<span>/ month</span>@endif
                            @else
                                <strong>Contact for pricing</strong>
                            @endif
                        </div>
                        <h3><a href="{{ $detailUrl }}">{{ $Property->p_title }}</a></h3>
                        @if($Property->p_address)
                            <p class="rr-address"><span aria-hidden="true">&#x2316;</span> {{ $Property->p_address }}</p>
                        @endif
                        <ul class="rr-facts" aria-label="Home features">
                            @if($Property->p_bedrooms)<li><strong>{{ $Property->p_bedrooms }}</strong> beds</li>@endif
                            @if($Property->p_baths)<li><strong>{{ $Property->p_baths }}</strong> baths</li>@endif
                            @if($Property->p_area)<li><strong>{{ $Property->p_area }}</strong> sq ft</li>@endif
                        </ul>
                        <a class="rr-card-link" href="{{ $detailUrl }}">View home details <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <section class="rr-empty-state">
            <h2>No homes found</h2>
            <p>Try another street or property name, or view all available homes.</p>
            <a class="rr-button" href="{{ url('our-properties') }}">View all homes</a>
        </section>
    @endif
    {{ $db_data['Property']->links() }}
</main>
@endsection
