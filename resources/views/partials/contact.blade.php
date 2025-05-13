@extends('layouts.public')

@section('title', 'Kontakt')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="container my-5">
    <div class="card shadow-lg rounded p-4 animate-on-scroll">
        <h2 class="mb-4">Ovde se nalazimo</h2>
        <div class="mb-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d90577.83591244112!2d20.313341324137525!3d44.81020852277143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7ab26eb107e9%3A0x7fd51b4702d8675c!2z0KDQsNGH0YPQvdCw0YDRgdC60Lgg0YTQsNC60YPQu9GC0LXRgiDQo9C90LjQstC10YDQt9C40YLQtdGC0LAg0KPQvdC40L7QvQ!5e0!3m2!1ssr!2srs!4v1746702373622!5m2!1ssr!2srs"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <h4 class="mb-3">Kontakt informacije:</h4>
        <p><i class="fa fa-map-marker me-2" style="width:20px"></i> VI, Kneza Mihaila 6, Beograd 11000</p>
        <p><i class="fa fa-phone me-2" style="width:20px"></i> 0606101510</p>
        <p><i class="fa fa-envelope me-2" style="width:20px"></i> vtodorovic5323it@raf.rs</p>
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
