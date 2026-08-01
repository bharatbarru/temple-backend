<div class="faq">
    @foreach ($faqs as $faq)
        <div class="border-bottom pb-3 mb-3 faq-item">
            <div data-target="#panel-{{ $faq->id }}" class="accordion-panel-title" data-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="panel-{{ $faq->id }}">
                <h3 class="mb-0">{{ $faq->question }}</h3>
                <span class="material-symbols-outlined plus-icon" >
                    add
                </span>
                <span class="material-symbols-outlined minus-icon">
                    remove
                </span>
            </div>
            <div class="collapse " id="panel-{{ $faq->id }}">
                <div class="pt-3">
                    <div class="des">
                        {!! $faq->answer !!}

                        @if ($faq->button_name)
                        <a class="btn btn-primary btn-sm" target="{{ $faq->new_window ? '_blank' : '_self' }}"
                            href="{{ $faq->button_url }}">
                            {{ $faq->button_name }}
                        </a>
                    @endif
                        


                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
