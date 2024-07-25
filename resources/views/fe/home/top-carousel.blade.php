<div id="myCarousel" class="carousel slide min-vh-100" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-indicators">
            @foreach($carousels as $index => $carousel)
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        
        @foreach($carousels as $index => $carousel)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="background-image: url('{{ asset($carousel->image_url) }}'); height: 100vh; background-size: cover; background-position: center;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="text-uppercase text-white fw-semibold display-1">
                        {{ $carousel->title }}
                    </h1>
                    <h5 class="text-uppercase text-white mt-3 mb-4">
                        {{ $carousel->description }}
                    </h5>
                    <div>
                        <a href="{{ $carousel->button_link }}" class="btn btn-brand me-2 mt-3">{{ $carousel->button_text }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
.carousel-item {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
.carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: rgba(0, 0, 0, 0.5); /* Optional: adds a semi-transparent background */
}
</style>
