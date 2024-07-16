@extends('student.layouts.app')

@section('content')
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Trainers</h1>
                        <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                            voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi
                            ratione sint. Sit quaerat ipsum dolorem.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Trainers</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="trainers" class="section trainers">

        <div class="container">

            <div class="row gy-5">
                @foreach ($instructors as $instructor)
                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{ asset('student/assets/img/trainers/trainer-1.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="social">
                                <div class="social">
                                    <a href="{{ $instructor->user->twitter }}"><i class="bi bi-twitter-x"></i></a>
                                    <a href="{{ $instructor->user->facebook }}"><i class="bi bi-facebook"></i></a>
                                    <a href="{{ $instructor->user->instagram }}"><i class="bi bi-instagram"></i></a>
                                    <a href="{{ $instructor->user->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>{{ $instructor->user->name }}</h4>
                            <span>Business</span>
                            <p>Aliquam iure quaerat voluptatem praesentium possimus unde laudantium vel dolorum distinctio
                                dire flow</p>
                        </div>
                    </div><!-- End Team Member -->
                @endforeach
            </div>

        </div>

    </section>
@endsection
