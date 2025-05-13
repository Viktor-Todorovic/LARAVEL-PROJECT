@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', $category->name)

@section('content')

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">{{ $category->name }}</h1>
        <p class="text-muted lead">{{ $category->description }}</p>
    </div>

    <div class="row d-flex flex-wrap">
        @foreach ($category->products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden rounded-3 animate-on-scroll">
                    
                    @if($product->promo === 'da')
                        <span class="badge w3-black position-absolute top-0 start-0 m-2 z-3">
                            Izabrano
                        </span>
                    @endif
                    
                    <div class="image-wrapper position-relative">
                        <img src="{{ asset($product->image) }}" class="card-img-top product-image rounded-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">

                        <div class="overlay-button position-absolute top-50 start-50 translate-middle text-center">
                            <a href="{{ route('product.show', $product->id) }}">
                                <button class="w3-button w3-black ms-auto" style="border-radius: 5px">Opširnije</button>
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
