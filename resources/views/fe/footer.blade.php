<!-- FOOTER -->
<footer class="bg-dark mt-5">
  <div class="footer-top">
    <div class="container">
      <div class="row gy-5">
        <div class="col-lg-4 col-sm-6 mr-10"> <!-- Ubah kolom ke 4 kolom -->
          <a href="/">
            <img src="{{ asset('assets/img/'.$mainConfig->footer_logo) }}" alt="logo footer" class="logo-footer" />
          </a>
          <div class="line"></div>
          <p>{{ $mainConfig->footer_text }}</p>
          <div class="social-icons">
            @foreach($socialMedia as $media)
            <a href="{{ $media->link }}" target="_blank" rel="noopener noreferrer">
              <i class="{{ $media->icon }}"></i>
            </a>
            @endforeach
          </div>
        </div>
        <div class="col-lg-1 col-sm-6"> <!-- Ubah kolom ke 4 kolom -->
        </div>
        <div class="col-lg-4 col-sm-6"> <!-- Ubah kolom ke 4 kolom -->
          <h5 class="mb-0 text-white">SERVICES</h5>
          <div class="line"></div>
          <ul>
            @foreach($mainSubService as $footerSubService)
              <li><a href="{{ $footerSubService->url_menu }}">{{ $footerSubService->heading }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="col-lg-2 col-sm-6"> <!-- Ubah kolom ke 4 kolom -->
          <h5 class="mb-0 text-white">CONTACT</h5>
          <div class="line"></div>
          <ul>
            @foreach($footerContact as $fContact)
              <li><a href="#">{{ $fContact->address }}</a></li>
              <li><a href="#">{{ $fContact->phone }}</a></li>
              <li><a href="#">{{ $fContact->url }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row g-4 justify-content-between">
        <div class="col-auto">
          <p class="mb-0">© Copyright. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</footer>
