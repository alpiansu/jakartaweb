@extends('fe.master-fe')
@section('title', 'Our Work')

@section('content')
<style>
.project-item {
    border: 1px solid #ddd;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    text-align: center;
}

.project-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

@media (max-width: 767px) {
    .project-item {
        margin-bottom: 20px;
    }
}
</style>

<section id="work" class="p-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title" data-aos="fade-down" data-aos-delay="150">
                    <h1 class="display-4 fw-semibold">Our Work</h1>
                    <div class="line"></div>
                    <p>
                        In our 20+ years, we have been fortunate enough to work alongside partners we admire to help create bespoke websites and generate extraordinary results. Experience some of our recent work.
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                <select class="form-control">
                    <option>All Projects</option>
                    <!-- Options for project types -->
                </select>
            </div>
            <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                <select class="form-control">
                    <option>All Sectors</option>
                    <!-- Options for sectors -->
                </select>
            </div>
        </div>
        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-4 col-sm-6 col-xs-12" data-aos="fade-down" data-aos-delay="150">
                    <div class="project-item">
                        <div class="project-image">
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="img-fluid" />
                        </div>
                        <h5 class="mt-3">{{ $project->title }}</h5>
                        <p class="text-muted">{{ $project->description }}</p>
                        <a href="{{ $project->link }}" class="btn btn-outline-primary">Open</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
