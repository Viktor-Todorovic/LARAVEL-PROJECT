@extends('layouts.public')

@section('title', $product->name)

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5" style="font-family: 'Arial', sans-serif; font-size: 3rem; color: #333;">{{ $product->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="mb-0 d-flex flex-column">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row justify-content-center animate-on-scroll">
        <div class="col-md-8">
            <div class="card shadow-lg rounded mb-4">
                <img src="{{ asset($product->image) }}" 
                    class="card-img-top rounded-top bg-white" 
                    style="height: 700px; object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #0056b3;">{{ $product->name }}</h5>
                    <p class="card-text" style="color: #555;">{!! $product->description !!}</p>
                    <p class="card-text"><strong>Cena:</strong> {{ number_format($product->price, 0) }} din.</p>
                    @if($product->promo === 'da')
                        <span class="badge  w3-black " style="z-index: 5555; width: 80px; height: 30px; font-size: 1rem; align-items: center; display: flex; justify-content: center;">
                            Izabran
                        </span>
                    @endif

                    @auth
                    <hr>
                    <h4 class="mb-4" style="font-size: 1.5rem; font-weight: bold;">Kupite proizvod</h4>
                    <form method="POST" action="{{ route('orders.store', $product->id) }}">
                        @csrf
                        <input type="hidden" name="katalog_id" value="{{ $product->katalog_id }}">

                        <div class="form-group mb-3">
                            <label for="kolicina">Količina</label>
                            <input type="number" name="kolicina" class="w3-input w3-border" placeholder="Unesite količinu" required value="{{ old('kolicina') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="message">Poruka</label>
                            <input type="text" name="message" class="w3-input w3-border" placeholder="Unesite poruku" required value="{{ old('message') }}">
                        </div>

                        <button type="submit" class="w3-button w3-black w-100" style="border-radius: 50px; padding: 10px; transition: all 0.3s ease;">Kupite proizvod</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @auth
    <div class="comment-form card shadow-lg rounded mb-4 p-4 animate-on-scroll" style="border: 1px solid #ddd;">
        <div class="card-body">
            <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold; color: #333;">Dodajte komentar</h5>

            <form method="POST" action="{{ route('comments.store', $product->id) }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="title">Naslov komentara</label>
                    <input type="text" name="title" class="w3-input w3-border" placeholder="Unesite naslov komentara" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="comment">Komentar (opciono):</label>
                    <textarea name="comment" class="w3-input w3-border" rows="3" placeholder="Unesite komentar">{{ old('comment') }}</textarea>
                    @error('comment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w3-button w3-black w-100" style="border-radius: 50px; padding: 8px; transition: all 0.3s ease;">Dodajte komentar</button>
            </form>
        </div>
    </div>
        
    @endauth

    <div class="comments-section mt-5 animate-on-scroll" style="background-color: #f4f4f4; padding: 30px 0; border-radius: 10px;">
        <h3 class="text-center mb-4" style="font-family: 'Arial', sans-serif; color: #333;">Komentari</h3>

        @forelse($product->comments as $comment)
        <div class="comment-item card shadow-sm mb-3" style="border-radius: 10px; border: 1px solid #ddd;">
            <div class="card-body">
                <h5 class="card-title" style="font-weight: bold; color: #333;">{{ $comment->title }}</h5>
                <p class="card-text" style="color: #555;">{!! $comment->comment !!}</p>
                <small class="text-muted" style="font-size: 0.9em;">
                    Korisnik: {{ $comment->user?->name ?? 'Nepoznat' }} |
                    Datum: {{ $comment->created_at->format('d.m.Y') }}
                </small>
            </div>
        </div>
        @empty
            <p class="text-center text-muted">Još uvek nema komentara za ovaj proizvod.</p>
        @endforelse
    </div>
</div>
@endsection

<style>
.comments-section {
    background-color: #f9f9f9;
    padding: 40px 0;
    border-radius: 10px;
}

.comment-form {
    border-radius: 10px;
    border: 1px solid #ddd;
}

.comment-item {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.comment-item .card-body {
    padding: 20px;
}

.comment-form input,
.comment-form textarea {
    border-radius: 8px;
    padding: 8px;
    border: 1px solid #ddd;
}

.comment-item .card-title {
    font-weight: bold;
    color: #333;
}

.comment-item .card-text {
    font-size: 1.1em;
    color: #666;
}

.comment-item small {
    font-size: 0.9em;
    color: #aaa;
}

.comment-form h5 {
    font-size: 1.25rem;
    margin-bottom: 10px;
}

.comment-item + .comment-item {
    margin-top: 20px;
}


.w3-button.w3-black {
    background-color: #000;
    color: #fff;
}

.w3-input {
    padding: 12px;
    border-radius: 6px;
}

.w3-input.w3-border {
    border: 1px solid #ddd;
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
