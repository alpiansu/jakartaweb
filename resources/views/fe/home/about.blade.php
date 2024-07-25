<section id="about" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">{{ $about->title }}</h1>
                    <div class="line"></div>
                    <p>{{ $about->description }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                <img src="{{ asset($about->image_url) }}" alt="about" />
            </div>
            <div class="col-lg-5" data-aos="fade-down" data-aos-delay="150">
                <h1 class="pt-4">{{ $about->title2 }}</h1>
                <p class="mt-3 mb-4">{{ $about->description2 }}</p>
                @foreach($about->features as $feature)
                <div class="d-flex mb-3">
                    <div class="iconbox me-4">
                        <i class="{{ $feature->icon }}"></i>
                    </div>
                    <div>
                        <h5>{{ $feature->title }}</h5>
                        <p>{{ $feature->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
