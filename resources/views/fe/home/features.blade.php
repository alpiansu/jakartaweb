<section id="features" class="section-padding mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Features</h1>
                    <div class="line"></div>
                    <p>We love to craft digital experiences for brands rather than crap and more lorem ipsums and do crazy skills</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            @foreach($features as $index => $feature)
                <div class="card ms-lg-3 mt-3" style="width: 23rem" data-aos="fade-down" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="card-body bg-dark">
                        <h5 class="card-title text-white text-center">{{ $feature->title }}</h5>
                        <p class="card-text text-white">{{ $feature->description }}</p>
                        <a href="{{ $feature->link_url }}" class="btn btn-brand">{{ $feature->link_text }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>