@extends('fe.master-fe')
@section('title', 'Jakartaweb')

@section('content')
  <section id="contact" class="pt-5 bg-light mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
          <div class="section-title">
            <h1 class="display-4 text-white fw-semibold">{{ $contact->title }}</h1>
            <div class="line bg-black"></div>
            <p class="text-white">
              {{ $contact->description }}
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
        <div class="col-lg-8">
          <form action="{{ route('contact.store') }}" class="row g-3 p-lg-5 p-4 bg-white theme-shadow" method="POST">
            @if(session('success'))
              <div class="alert alert-success mt-3">
                  {{ session('success') }}
              </div>
            @elseif(session('error'))
              <div class="alert alert-danger mt-3">
                  {{ session('error') }}
              </div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
            @csrf
            <div class="form-group col-lg-6">
              <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" />
            </div>
            <div class="form-group col-lg-6">
              <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" />
            </div>
            <div class="form-group col-lg-12">
              <input type="email" name="email" class="form-control" placeholder="Enter Email Address" />
            </div>
            <div class="form-group col-lg-12">
              <input type="text" name="subject" class="form-control" placeholder="Enter Subject" />
            </div>
            <div class="form-group col-lg-12">
              <textarea
                name="message"
                rows="5"
                class="form-control"
                placeholder="Enter Message"
              ></textarea>
            </div>
            <div class="form-group col-lg-12 d-grid">
              <button class="btn btn-brand">{{ $contact->button_text }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
