@php
    $progress = (int) round(($currentStep / $totalSteps) * 100);
@endphp

<section class="rr-application-progress" aria-label="Rental application progress">
    <div class="rr-application-progress__header">
        <div>
            <p class="rr-application-progress__eyebrow">Rental application</p>
            <p class="rr-application-progress__step">Step {{ $currentStep }} of {{ $totalSteps }}</p>
        </div>
        <span class="rr-application-progress__percentage">{{ $progress }}% complete</span>
    </div>
    <div
        class="rr-application-progress__track"
        role="progressbar"
        aria-label="Application completion"
        aria-valuemin="0"
        aria-valuemax="{{ $totalSteps }}"
        aria-valuenow="{{ $currentStep }}"
    >
        <span class="rr-application-progress__fill" style="width: {{ $progress }}%"></span>
    </div>
</section>
