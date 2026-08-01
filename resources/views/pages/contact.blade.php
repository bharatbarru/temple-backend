@extends('frontend.app')
@section('title')
    {{ $page->title }}
@endsection
@section('seotitle')
    {{ $page->seo_title }}
@endsection
@section('seodescription')
    {{ $page->seo_description }}
@endsection
@section('seokeywords')
    {{ $page->seo_keywords }}
@endsection
@section('pageclassname')
    contact-main-page
@endsection
@section('content')
    {{-- ----------inner-banner------------- --}}
    <section class="bg-dark text-light header-inner p-0  inner-banner">
        @if ($page->banner_image != '')
            <figure class="m-0">
                <img src="{{ asset('images/inner-pages/' . $page->banner_image) }}" alt="{{ $page->banner_image_alt_text }}"
                    class="w-100" />
            </figure>
        @else
            <figure class="m-0">
                <img src="{{ asset('assets/inner-banner.webp') }}" alt="{{ $page->title }}" class="w-100">
            </figure>
        @endif
        <div class="inner-text text-center">
            <div class="container">
                <h1 class="display-2">{{ $page->banner_title != '' ? $page->banner_title : $page->title }}</h1>
            </div>
        </div>
    </section>
    {{-- ----------end of inner-banner------------- --}}
    <section class="contact-page">
        <div class="container">
      
            <div class="row  justify-content-between contact-addres-left">
                <div class="col-md-6 mob-order-2">
                    <div class="row text-center">
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-telephone"></i></div>
                                <h4 class="font-700">Phone Number</h4>
                                <a href="tel:{!! applicationSettings('primary-phone-number') !!}">
                                    {!! applicationSettings('primary-phone-number') !!} (Call/Text)</a>
                                <a href="tel:{!! applicationSettings('secondary-phone-number') !!}">
                                    {!! applicationSettings('secondary-phone-number') !!} ( Landline)</a>
                            </div>
                        </div>
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-email-1"></i></div>
                                <h4 class="font-700">Email Address</h4>
                                <a href="mailto:{!! applicationSettings('primary-email') !!}">
                                    {!! applicationSettings('primary-email') !!}</a>
                                <a href="mailto:{!! applicationSettings('secondary-email') !!}">
                                    {!! applicationSettings('secondary-email') !!}</a>
                            </div>
                        </div>
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-placeholder"></i></div>
                                <h4 class="font-700">Location</h4>
                                <a href="{!! applicationSettings('location-url') !!}">
                                    {!! applicationSettings('address') !!}</a>
                            </div>
                        </div>
                        <div class="col-md-6 box-list-item mb-3">
                            <div class="card p-3 shadow h-100 mb-0">
                                <div class="shadow icon"><i class="flaticon-clock-1"></i></div>
                                <h4 class="font-700">Open & Closing</h4>
                                <div class="text-time">
                                    {!! applicationSettings('open-closing') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mob-order-1">

                    @if (isset($page) && $page->banner_tagline != '')
                    <div class=" mb-1">
                        <h2 class="h1"> {!! $page->banner_tagline !!} </h2>
                    </div>
                    <hr/>
                    @endif

                    <form action="{{ url('contact-form-submission') }}" method="POST" id="contact-form">
                        {{ csrf_field() }}
                        <div class="row">
                            @honeypot
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Your Name *</label>
                                    <input name="name" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please type your name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input name="email" type="email" placeholder="yourname@mail.com"
                                        class="form-control" required>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input name="company" type="text" class="form-control" required>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input name="phone" type="tel" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Message:</label>
                                    <textarea class="form-control" name="message" rows="5" placeholder="How can we help?"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                
                                <div class="our-captcha">
                                <div class="g-recaptcha" data-callback="imNotARobot"
                                    data-sitekey="6LcCslYqAAAAAC3oPw2Lz-QPQoiZRDrdnfBoSa8H"></div>
                                <div id="captchaerrors"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-none alert alert-success" role="alert" data-success-message="">
                                        Thanks, a member of our team will be in touch shortly.
                                    </div>
                                    {{-- <div class="d-none alert alert-danger" role="alert" data-error-message="">
                                        Please fill all fields correctly.
                                    </div> --}}
                                    <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Sending"
                                        id="contact_btn">
                                        <img class="icon" src="" alt="loading icon" data-inject-svg="">
                                        <span>Send Enquiry</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('pages.recaptcha')
    <section class="p-0 location-iframe">
        {!! applicationSettings('location-iframe') !!}
    </section>
    @if ($faqCategory)
        @include('common.faqs', ['faqs' => $faqCategory->faqs]);
    @endif
@endsection
