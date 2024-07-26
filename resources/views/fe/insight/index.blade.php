@extends('fe.master-fe')
@section('title', 'Jakartaweb')

@section('content')
<section id="blog" class="mt-5 p-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">{{ $insight_text->title }}</h1>
                    <div class="line"></div>
                    <p>
                        {{ $insight_text->content }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-md-4 pt-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="blog-post image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ asset('assets/img/' . $blog->image_path) }}" alt="{{ $blog->title }}" />
                        </div>
                        <h5 class="mt-4">{{ $blog->title }}</h5>
                        <p class="mb-0">
                            {{ Str::limit($blog->description, 100, '...') }}
                        </p>
                        <a href="{{ $blog->link }}" class="mt-0">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
