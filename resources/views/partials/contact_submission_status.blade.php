<section class="rr-contact-result {{ $success ? 'rr-contact-result--success' : 'rr-contact-result--error' }}" role="status" aria-live="polite">
    <span class="rr-contact-result__icon" aria-hidden="true">
        <i class="fas {{ $success ? 'fa-check' : 'fa-exclamation' }}"></i>
    </span>
    <p class="rr-contact-result__eyebrow">{{ $success ? 'Message received' : 'Message not sent' }}</p>
    <h3>{{ $success ? 'Thanks for reaching out.' : 'We could not send your message.' }}</h3>
    <p>
        {{ $success
            ? 'Our team has received your inquiry and will follow up using the contact information you provided.'
            : 'Please try again, or contact our team by phone or email using the details on this page.' }}
    </p>
    <a class="theme-btn-1 btn btn-effect-1" href="{{ url('/contact-us') }}#form_container">
        {{ $success ? 'Send another message' : 'Return to the contact form' }}
    </a>
</section>
