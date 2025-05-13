@extends('layouts.app')

@section('header')
    Dodaj komentar
@endsection

@section('content')


<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ route('admin.comments.insert') }}">
    @csrf

    <div class="mb-3">
        <label for="product_id" class="form-label">Proizvod</label>
        <select class="w3-input w3-border" id="product_id" name="product_id" required>
            <option value="" disabled selected>Izaberite proizvod</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Naslov</label>
        <input type="text" class="w3-input w3-border" id="title" name="title" value="{{ old('title') }}">
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">Komentar</label>
        <textarea class="w3-input w3-border" rows="4" id="comment" name="comment">{{ old('comment') }}</textarea>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.comments.list') }}" class="btn btn-secondary">Nazad</a>
        <button type="submit" class="w3-button w3-black ms-auto">Dodaj</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#comment').summernote({
            height: 300,
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
