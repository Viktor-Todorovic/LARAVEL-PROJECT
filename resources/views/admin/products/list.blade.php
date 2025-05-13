@extends('layouts.app')

@section('header')
    <h1>Lista proizvoda</h1>
@endsection

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<a href="{{ route('admin.products.create') }}" class="btn btn-success w3-right mb-3">Dodaj novi proizvod</a>

<table id="products-table" class="table table-striped">
    <thead>
        <tr>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Cena</th>
            <th>Kategorija</th>
            <th>Izabran</th>
            <th>Opcije</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{!! Str::limit(strip_tags($product->description), 50) !!}</td>
                <td>{{ number_format($product->price, 0) }} din.</td>
                <td>{{ $product->category->name }}</td>
                <td> {!! $product->promo === 'da' ? '✔' : '❌' !!}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">Izmeni</a>
                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Da li si siguran da želiš da obrišeš ovaj proizvod?')">Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#products-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/sr-SP.json"
            }
        });
    });
</script>

@endsection
