@extends('layouts.app')

@section('header')
    Dodaj proizvod
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

<form method="post" action="{{ route('admin.products.insert') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
    <label for="naziv_proizvoda" class="form-label">Naziv proizvoda</label>
    <input type="text" class="w3-input w3-border @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
</div>


    <div class="mb-3">
        <label for="opis" class="form-label">Opis</label>
        <textarea class="w3-input w3-border @error('description') is-invalid @enderror" rows="6" id="description" name="description" required>{{ old('description') }}</textarea>
    </div>


    <div class="mb-3">
        <label for="cena" class="form-label">Cena</label>
        <input type="number" class="w3-input w3-border @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
    </div>


    <div class="mb-3">
        <label for="category_id" class="form-label">Kategorija:</label>
        <select class="form-label @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 d-flex flex-column">
    <label for="slika_proizvoda" class="form-label">Slika proizvoda</label>
    <input type="file" class="w3-input w3-border p-3 @error('image') is-invalid @enderror" name="image" id="image" accept="image/*" required>
</div>


    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="promo" id="promo" value="da">
        <label class="form-check-label" for="promo">Izabran proizvod</label>
    </div>

    <div class="dugmici d-flex">
        <a href="{{ route('admin.products.list') }}" class="btn btn-secondary">Vrati nazad</a>
        <button type="submit" class="w3-button w3-black ms-auto">Dodaj</button>
    </div>
</form>


<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>

@endsection
