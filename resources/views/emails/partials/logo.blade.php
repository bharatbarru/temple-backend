{{-- Temple logo for e-mails. Embedded as an inline (CID) attachment so that it
     renders even when the mail client blocks remote images. --}}
@php $emailLogoPath = emailLogoPath(); @endphp
@if ($emailLogoPath && isset($message))
    <img style="line-height: 1px; margin: 0; padding: 0; border: 0; display: block;" width="250"
        src="{{ $message->embed($emailLogoPath) }}" alt="{{ emailLogoAltText() }}" />
@else
    <img style="line-height: 1px; margin: 0; padding: 0; border: 0; display: block;" width="250"
        src="{{ emailLogoUrl() }}" alt="{{ emailLogoAltText() }}" />
@endif
