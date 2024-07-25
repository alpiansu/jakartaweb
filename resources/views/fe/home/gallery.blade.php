<section id="carou" class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">{{ $gallery->title }}</h1>
                    <div class="line"></div>
                    <p>{{ $gallery->content }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto" data-aos="fade-down" data-aos-delay="150">
                <div class="book-table-img-slider" id="icon">
                    <div class="swiper-wrapper">
                        @foreach($images as $image)
                            <a href="{{ asset('assets/galleries/' . $image) }}" data-fancybox="table-slider"
                               class="book-table-img back-img swiper-slide"
                               style="background-image: url({{ asset('assets/galleries/' . $image) }})"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>