@extends('layouts.public')

@section('title', 'O nama')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="container my-5">
    <div class="card shadow-lg p-5 animate-on-scroll">
        <h2 class="text-center mb-3">O salonu</h2>
        <p class="text-center text-muted fst-italic mb-4">Mi volimo modu i odeću</p>
        <p class="text-justify">
            Krojački salon je osnovan iz ljubavi prema modi i želje da se klijentima ponudi visokokvalitetna, personalizovana odeća, prilagođena njihovim potrebama i stilu. Jasna vizija, tržišna prilika i posvećenost kvalitetu postavljeni su kao temelj poslovanja. 
            <br><br>
            Salon kombinuje tradicionalne krojačke tehnike sa modernim pristupom i inovativnim rešenjima, čime se razlikuje od ostalih salona na tržištu i pruža jedinstveno korisničko iskustvo.
        </p>

        <div class="row mt-5 align-items-center justify-content-center">
            <div class="col-md-6 text-center">
                <h5 class="mb-1">Osnivač</h5>
                <p class="fw-bold">Viktor Todorović</p>
                <img src="{{ asset('images/logo.png') }}" alt="Osnivač" class="img-fluid rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
        </div>
    </div>
</div>
@endsection

<style>
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
