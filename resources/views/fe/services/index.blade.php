@extends('fe.master-fe')
@section('title', 'Jakartaweb')

@section('content')
<section id="services-1" class="mt-5 p-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">UI/UX Designing</h1>
                    <div class="line"></div>
                    <p>
                        We love to craft digital experiences for brands rather than crap and more lorem ipsums
                        and do crazy skills
                    </p>
                </div>
            </div>
        </div>
        <div class="row g-4 text-center">
            @foreach($services as $service)
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="{{ $service->icon_class }}"></i>
                        </div>
                        <h5 class="mt-4 mb-3">{{ $service->title }}</h5>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="counter" class="section-padding mt-5 mb-5">
    <div class="container text-center">
        <div class="row g-4">
            @foreach($counters as $counter)
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <h1 class="text-white display-4">{{ $counter->value }}</h1>
                    <h6 class="text-uppercase text-white mt-3 mb-0">{{ $counter->subtitle }}</h6>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
