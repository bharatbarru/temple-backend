@php
    $categoryName = 'homepage';
    $images = getPhotoGalleryByCategory($categoryName);
    $data = $images ? json_decode($images, true) : null;
@endphp

<section class="p-0 our-gallery bg-tertiary text-light">
    @if ($data !== null && $data !== [])
        <div class="row">
            <div class="col-md-6  order-2 order-md-1  mobile-first">
                <a href="{{ asset(PHOTO_GALLERY_IMAGE_PATH . $data[0]['path']) }}" data-fancybox="Gallery Example" data-options='{"loop":true}' class="d-block w-100 right-gallery our-gallery-link" data-aos="zoom-in">
                    <img src="{{ asset(PHOTO_GALLERY_IMAGE_PATH . $data[0]['path']) }}" alt="{{ $data[0]['alt_text'] }}" class="object-fit-cover w-100 h-100 ">
                </a>
            </div>
            <div class="col-md-6 mb-3 pr-4 order-1 order-md-2 ">
                <div class="row py-5 pl-2 justify-content-between align-items-center gallery-title">
                <h2 class="section-title w-bg">Our Gallery</h2>
                <a href="#" class="d-inlne mr-3 arrow-hover ">View our gallery >></a>
            </div>
                <div class="row">
                    @foreach ($data as $key => $image)
                        @if ($key > 0 && $key <= 4)
                            <div class="col-md-6 mb-3">
                                <a href="{{ asset(PHOTO_GALLERY_IMAGE_PATH . $image['path']) }}" data-fancybox="Gallery Example" data-options='{"loop":true}' class="d-block w-100  our-gallery-link left-gallery" data-aos="zoom-in">
                                    <img src="{{ asset(PHOTO_GALLERY_IMAGE_PATH . $image['path']) }}" alt="{{ $image['alt_text'] }}" class="object-fit-cover w-100 h-100 ">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
         
        </div>
    @else
        <p>No galleries found for the "home" category.</p>
    @endif
    <a href="#" class="btn btn-primary mb-5 d-md-none">View our gallery</a>
</section>
