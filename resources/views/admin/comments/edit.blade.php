@extends('layouts.app')

@section('header')
    Izmeni komentar
@endsection

@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<form method="POST" action="{{ route('admin.comments.update', ['id' => $comment->id]) }}">
    @csrf


    <div class="mb-3">
        <label class="form-label">Korisnik</label>
        <input type="text" class="w3-input w3-border" value="{{ $comment->user->name ?? 'Nepoznat korisnik' }}" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Proizvod</label>
        <input type="text" class="w3-input w3-border" value="{{ $comment->product->name ?? 'Nepoznat proizvod' }}" disabled>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Naslov</label>
        <input type="text" class="w3-input w3-border" id="title" name="title" value="{{ old('title', $comment->title) }}">
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">Komentar</label>
        <textarea id="comment" name="comment" class="w3-input w3-border" rows="5" required>{!! old('comment', $comment->comment) !!}</textarea>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.comments.list') }}" class="btn btn-secondary">Nazad</a>
        <button type="submit" class="w3-button w3-black">Sačuvaj izmene</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#comment').summernote({
            height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>

@endsection
