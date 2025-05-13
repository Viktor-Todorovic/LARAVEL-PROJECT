@extends('layouts.public')

@section('title', 'VT - Krojački salon')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')

    <div class="w3-display-container w3-container animate-on-scroll">
        <img src="{{ asset('images/logo2.png') }}" alt="Jeans" class="hero-image" style="border-radius: 20px">
        <div class="w3-display-topleft text-white" style="padding: 2rem 3rem;">
            <h1 class="display-3 fw-bold" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.5); letter-spacing: 2px;">Nova odeća</h1>
            <h4 class="w3-hide-small">Kolekcija 2025</h4>
            <p class="mt-3">
                <a href="#katalog" class="w3-button w3-black w3-padding-large w3-large rounded-pill shadow-sm">
                    KATALOG
                </a>
            </p>
        </div>
    </div>

    <h2 class="animate-on-scroll" style="text-align:center; border-bottom: 2px solid #ccc; padding-bottom: 0.3em; margin-bottom: 1em; padding-top: 1em;">
        Izabrani proizvodi
    </h2>

    <div class="container">
        <div class="row flex-wrap" id="katalog">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 animate-on-scroll">
                    <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden rounded-3">
                        <div class="image-wrapper position-relative">
                            <img src="{{ asset($product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}"
                                 style="height: 250px; object-fit: cover;">

                            <span class="badge  w3-black position-absolute top-0 start-0 m-2" style="z-index: 2;">
                                Izabran
                            </span>

                            <div class="overlay-button position-absolute top-50 start-50 translate-middle text-center">
                                <a href="{{ route('product.show', $product->id) }}">
                                    <button class="w3-button w3-black" style="border-radius: 5px">Opširnije</button>
                                </a>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <h6 class="card-title mb-1 text-truncate">{{ $product->name }}</h6>
                            <p class="card-text text-muted mb-0">{{ number_format($product->price, 0) }} din.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>

        .hero-image {
            object-fit: cover;
            width: 100%;
            height: 800px; 
            position: relative;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease, border 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            border: 2px solid #000;
        }

        .product-image {
            transition: transform 0.3s ease-in-out, filter 0.3s ease;
        }

        .image-wrapper:hover .product-image {
            transform: scale(1.05);
            filter: brightness(80%);
        }

        .image-wrapper .overlay-button {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .image-wrapper:hover .overlay-button {
            opacity: 1;
        }

        .card-body {
            border-top: 1px solid #eee;
            padding: 15px;
        }

        .card-title {
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 0.9em;
            color: #777;
        }

        .card-body p {
            font-size: 1em;
            margin-top: 10px;
        }

        .card-title.text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.appear {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('appear');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

@endsection
