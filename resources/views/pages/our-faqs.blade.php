@if ($faqCategory)
    @include('common.faqs', ['faqs' => $faqCategory->faqs])
@endif
