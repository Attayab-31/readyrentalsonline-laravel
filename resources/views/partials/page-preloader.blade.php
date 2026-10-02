@php
    $logo = asset('logo/ready_rentals_dark.svg') . '?v=' . filemtime(public_path('logo/ready_rentals_dark.svg'));
    $showOnLoad = request()->path() === '/';
    $wordmark = [
        '68.5% 89.5% 19.5% 2.7%',
        '68.5% 82.2% 19.5% 10.4%',
        '68.5% 73.9% 19.5% 17.2%',
        '68.5% 64.1% 19.5% 25.6%',
        '68.5% 54.9% 19.5% 34.7%',
        '68.5% 46.4% 19.5% 43.9%',
        '68.5% 39% 19.5% 51.6%',
        '68.5% 29.7% 19.5% 58.5%',
        '68.5% 22.3% 19.5% 67.7%',
        '68.5% 13.2% 19.5% 74.9%',
        '68.5% 9.2% 19.5% 83.3%',
        '68.5% 2.2% 19.5% 89.5%',
        '83.5% 84.8% 4.5% 2.7%',
        '83.5% 73% 4.5% 14.4%',
        '83.5% 64.2% 4.5% 26%',
        '83.5% 58.2% 4.5% 34.6%',
        '83.5% 46.4% 4.5% 40.8%',
        '83.5% 37.4% 4.5% 52%',
        '83.5% 31.8% 4.5% 61%',
        '83.5% 22% 4.5% 67%',
        '83.5% 10% 4.5% 77%',
        '83.5% 1.3% 4.5% 89%',
    ];
@endphp

<div class="rr-page-preloader{{ $showOnLoad ? ' rr-page-preloader--animating' : '' }}" data-rr-page-preloader @if($showOnLoad) data-rr-page-preloader-on-load @endif role="status" aria-live="polite" aria-atomic="true" aria-hidden="{{ $showOnLoad ? 'false' : 'true' }}">
    <div class="rr-page-preloader__content">
        <div class="rr-page-preloader__art" aria-hidden="true">
            <svg class="rr-page-preloader__house" viewBox="0 0 520 400" aria-hidden="true" focusable="false">
                <defs>
                    <linearGradient id="rr-preloader-house-blue" x1="10%" y1="90%" x2="90%" y2="10%">
                        <stop offset="0%" stop-color="#2b425a"/>
                        <stop offset="14%" stop-color="#3d5871"/>
                        <stop offset="31%" stop-color="#6a859e"/>
                        <stop offset="45%" stop-color="#4d6982"/>
                        <stop offset="58%" stop-color="#304861"/>
                        <stop offset="71%" stop-color="#7591a9"/>
                        <stop offset="83%" stop-color="#8ba4b9"/>
                        <stop offset="93%" stop-color="#4d6983"/>
                        <stop offset="100%" stop-color="#263c54"/>
                    </linearGradient>
                    <linearGradient id="rr-preloader-window-blue" x1="5%" y1="100%" x2="95%" y2="0%">
                        <stop offset="0%" stop-color="#4b657d"/>
                        <stop offset="22%" stop-color="#7894aa"/>
                        <stop offset="41%" stop-color="#aec4d4"/>
                        <stop offset="55%" stop-color="#6e899f"/>
                        <stop offset="69%" stop-color="#c8d9e4"/>
                        <stop offset="84%" stop-color="#7d99af"/>
                        <stop offset="100%" stop-color="#4c657c"/>
                    </linearGradient>
                    <linearGradient id="rr-preloader-swoosh" x1="8%" y1="100%" x2="92%" y2="0%">
                        <stop offset="0%" stop-color="#5d6267"/>
                        <stop offset="14%" stop-color="#7b8187"/>
                        <stop offset="28%" stop-color="#b8bec3"/>
                        <stop offset="40%" stop-color="#e6e9eb"/>
                        <stop offset="50%" stop-color="#c9ced2"/>
                        <stop offset="61%" stop-color="#7b8288"/>
                        <stop offset="72%" stop-color="#9ba2a8"/>
                        <stop offset="84%" stop-color="#dfe3e6"/>
                        <stop offset="94%" stop-color="#b7bdc2"/>
                        <stop offset="100%" stop-color="#767d83"/>
                    </linearGradient>
                    <linearGradient id="rr-preloader-divider" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#2d445b"/>
                        <stop offset="20%" stop-color="#4b647b"/>
                        <stop offset="40%" stop-color="#7b93a6"/>
                        <stop offset="53%" stop-color="#9fb1bf"/>
                        <stop offset="67%" stop-color="#6b8297"/>
                        <stop offset="84%" stop-color="#496176"/>
                        <stop offset="100%" stop-color="#294056"/>
                    </linearGradient>
                </defs>
                <rect class="rr-page-preloader__piece" x="307" y="34" width="27" height="66" rx="1.5" fill="url(#rr-preloader-house-blue)" style="--rr-piece-delay: 650ms;"/>
                <path class="rr-page-preloader__piece" d="M153 203 L153 104 L257 15 L257 42 L176 111 L176 190 Z" fill="url(#rr-preloader-house-blue)" style="--rr-piece-delay: 950ms;"/>
                <path class="rr-page-preloader__piece" d="M257 15 L371 109 L342 108 L257 42 Z" fill="url(#rr-preloader-house-blue)" style="--rr-piece-delay: 1200ms;"/>
                <path class="rr-page-preloader__piece" d="M153 203 L153 104 L257 15 L371 109 L342 108 L257 42 L176 111 L176 190 Z" fill="none" stroke="#0b1522" stroke-width="1.1" stroke-linejoin="miter" style="--rr-piece-delay: 1400ms;"/>
                <path class="rr-page-preloader__piece" d="M159 103 L257 20 L364 108" fill="none" stroke="#e8f3ff" stroke-opacity=".30" stroke-width="2.1" stroke-linecap="square" style="--rr-piece-delay: 1550ms;"/>
                <path class="rr-page-preloader__piece" d="M176 111 L257 42 L342 108" fill="none" stroke="#071225" stroke-opacity=".72" stroke-width="3.6" stroke-linejoin="miter" style="--rr-piece-delay: 1700ms;"/>
                <rect class="rr-page-preloader__piece" x="237" y="101" width="18" height="18" rx="1.1" fill="url(#rr-preloader-window-blue)" stroke="#263e59" stroke-width="1" style="--rr-piece-delay: 1850ms;"/>
                <rect class="rr-page-preloader__piece" x="259" y="101" width="18" height="18" rx="1.1" fill="url(#rr-preloader-window-blue)" stroke="#263e59" stroke-width="1" style="--rr-piece-delay: 2000ms;"/>
                <rect class="rr-page-preloader__piece" x="237" y="123" width="18" height="18" rx="1.1" fill="url(#rr-preloader-window-blue)" stroke="#263e59" stroke-width="1" style="--rr-piece-delay: 2150ms;"/>
                <rect class="rr-page-preloader__piece" x="259" y="123" width="18" height="18" rx="1.1" fill="url(#rr-preloader-window-blue)" stroke="#263e59" stroke-width="1" style="--rr-piece-delay: 2300ms;"/>
                <path class="rr-page-preloader__piece" d="M239 103 H253 M261 103 H275 M239 125 H253 M261 125 H275" fill="none" stroke="#f1f7fb" stroke-width=".9" stroke-opacity=".36" style="--rr-piece-delay: 2450ms;"/>
                <path class="rr-page-preloader__piece" d="M134 223 C213 179 295 148 388 136 C300 164 224 200 183 232 L134 230 Z" fill="url(#rr-preloader-swoosh)" stroke="#4b6277" stroke-opacity=".8" stroke-width="1.1" stroke-linejoin="round" style="--rr-piece-delay: 2650ms;"/>
                <path class="rr-page-preloader__piece" d="M139 223 C215 182 295 151 381 139" fill="none" stroke="#ffffff" stroke-opacity=".52" stroke-width="1.5" style="--rr-piece-delay: 2800ms;"/>
                <path class="rr-page-preloader__piece" d="M138 229 L182 231 C231 197 294 168 360 147" fill="none" stroke="#24384e" stroke-opacity=".28" stroke-width="1.3" style="--rr-piece-delay: 2920ms;"/>
                <rect class="rr-page-preloader__piece" x="15" y="251" width="486" height="5" rx="1.5" fill="url(#rr-preloader-divider)" style="--rr-piece-delay: 3050ms;"/>
            </svg>
            @foreach ($wordmark as $index => $clip)
                <img
                    class="rr-page-preloader__piece rr-page-preloader__word"
                    src="{{ $logo }}"
                    alt=""
                    aria-hidden="true"
                    draggable="false"
                    style="--rr-piece-clip: {{ $clip }}; --rr-piece-delay: {{ 3200 + ($index * 58) }}ms;"
                >
            @endforeach
        </div>
        <span class="rr-page-preloader__message" data-rr-page-preloader-message>Getting your home-search experience ready…</span>
        <span class="rr-page-preloader__track" aria-hidden="true"></span>
    </div>
</div>
