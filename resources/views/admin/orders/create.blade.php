@extends('layouts.app')

@section('header')
    Dodaj porudžbinu
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

<form method="post" action="{{ route('admin.orders.insert') }}" enctype="multipart/form-data">
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
        <label for="quantity" class="form-label">Količina</label>
        <input type="number" class="w3-input w3-border" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Napomena kupca:</label>
        <textarea class="w3-input w3-border" rows="4" id="message" name="message">{{ old('message') }}</textarea>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.orders.list') }}" class="btn btn-secondary">Nazad</a>
        <button type="submit" class="w3-button w3-black ms-auto">Dodaj</button>
    </div>
</form>


<script>
    $(document).ready(function() {
        $('#message').summernote({
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
