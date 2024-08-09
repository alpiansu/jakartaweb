<!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{ asset('assets/img/'.$mainConfig->logo) }}" alt="logo" class="top-logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle {{ Request::is('service*') ? 'active' : '' }}"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Services
            </a>
            <ul class="dropdown-menu">
              @foreach($mainSubService as $headSubService)
                <li><a href="/service/{{ $headSubService->id }}" class="dropdown-item">{{ $headSubService->menu_name }}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a href="/work" class="nav-link {{ Request::is('work*') ? 'active' : '' }}">Our Work</a>
          </li>
          <li class="nav-item">
            <a href="/insight" class="nav-link {{ Request::is('insight*') ? 'active' : '' }}">Insight</a>
          </li>
        </ul>
        <a href="/contact" class="btn btn-brand ms-lg-3 {{ Request::is('contact*') ? 'active' : '' }}">Contact</a>
      </div>
    </div>
  </nav>