@php
    $logo = asset('logo/ready_rentals_dark.svg');
    $showOnLoad = request()->path() === '/';
    $logoPieces = [
        ['id' => 'rr-loader-window-1', 'type' => 'window', 'delay' => 0],
        ['id' => 'rr-loader-window-2', 'type' => 'window', 'delay' => 180],
        ['id' => 'rr-loader-window-3', 'type' => 'window', 'delay' => 360],
        ['id' => 'rr-loader-window-4', 'type' => 'window', 'delay' => 540],
        ['id' => 'rr-loader-window-glint', 'type' => 'window-glint', 'delay' => 700],
        ['id' => 'rr-loader-chimney', 'type' => 'chimney', 'delay' => 1030],
        ['id' => 'rr-loader-house-roof', 'type' => 'house', 'delay' => 1190],
        ['id' => 'rr-loader-roof-highlight', 'type' => 'roof-highlight', 'delay' => 1430],
        ['id' => 'rr-loader-roof-shadow', 'type' => 'roof-shadow', 'delay' => 1570],
        ['id' => 'rr-loader-swoosh', 'type' => 'swoosh', 'delay' => 1900],
        ['id' => 'rr-loader-swoosh-highlight', 'type' => 'swoosh-highlight', 'delay' => 2070],
        ['id' => 'rr-loader-swoosh-shadow', 'type' => 'swoosh-shadow', 'delay' => 2190],
        ['id' => 'rr-loader-divider-line', 'type' => 'divider', 'delay' => 2310],
    ];

    $wordmark = [
        ['clip' => '68.5% 89.5% 19.5% 2.7%'],
        ['clip' => '68.5% 82.2% 19.5% 10.4%'],
        ['clip' => '68.5% 73.9% 19.5% 17.2%'],
        ['clip' => '68.5% 64.1% 19.5% 25.6%'],
        ['clip' => '68.5% 54.9% 19.5% 34.7%'],
        ['clip' => '68.5% 46.4% 19.5% 43.9%'],
        ['clip' => '68.5% 39% 19.5% 51.6%'],
        ['clip' => '68.5% 29.7% 19.5% 58.5%'],
        ['clip' => '68.5% 22.3% 19.5% 67.7%'],
        ['clip' => '68.5% 13.2% 19.5% 74.9%'],
        ['clip' => '68.5% 9.2% 19.5% 83.3%'],
        ['clip' => '68.5% 2.2% 19.5% 89.5%'],
        ['clip' => '83.5% 84.8% 4.5% 2.7%'],
        ['clip' => '83.5% 73% 4.5% 14.4%'],
        ['clip' => '83.5% 64.2% 4.5% 26%'],
        ['clip' => '83.5% 58.2% 4.5% 34.6%'],
        ['clip' => '83.5% 46.4% 4.5% 40.8%'],
        ['clip' => '83.5% 37.4% 4.5% 52%'],
        ['clip' => '83.5% 31.8% 4.5% 61%'],
        ['clip' => '83.5% 22% 4.5% 67%'],
        ['clip' => '83.5% 10% 4.5% 77%'],
        ['clip' => '83.5% 1.3% 4.5% 89%'],
    ];

@endphp

<div class="rr-page-preloader{{ $showOnLoad ? ' rr-page-preloader--animating' : '' }}" data-rr-page-preloader @if($showOnLoad) data-rr-page-preloader-on-load @endif role="status" aria-live="polite" aria-atomic="true" aria-hidden="{{ $showOnLoad ? 'false' : 'true' }}">
    <div class="rr-page-preloader__content">
        <div class="rr-page-preloader__art" aria-hidden="true">
            <svg class="rr-page-preloader__house" viewBox="0 0 520 400" focusable="false" aria-hidden="true">
            @foreach ($logoPieces as $piece)
                <use
                    class="rr-page-preloader__piece rr-page-preloader__piece--{{ $piece['type'] }}"
                    href="{{ $logo }}#{{ $piece['id'] }}"
                    style="--rr-piece-delay: {{ $piece['delay'] }}ms;"
                />
            @endforeach
            </svg>
            @foreach ($wordmark as $index => $letter)
                <img
                    class="rr-page-preloader__piece rr-page-preloader__word"
                    src="{{ $logo }}"
                    alt=""
                    aria-hidden="true"
                    draggable="false"
                    style="--rr-piece-clip: {{ $letter['clip'] }}; --rr-piece-delay: {{ 2500 + ($index * 58) }}ms;"
                >
            @endforeach
        </div>
        <span class="rr-page-preloader__message" data-rr-page-preloader-message>Getting your home-search experience ready…</span>
        <span class="rr-page-preloader__track" aria-hidden="true"></span>
    </div>
</div>
