@extends('layouts.app')

@section('header')
    <h1>Lista komentara</h1>
@endsection

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<a href="{{ route('admin.comments.create') }}" class="btn btn-success w3-right mb-3">Dodaj novi komentar</a>

<table id="comments-table" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Korisnik</th>
            <th>Proizvod</th>
            <th>Naslov</th>
            <th>Komentar</th>
            <th>Datum</th>
            <th>Opcije</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id}}</td>
                <td>{{ $comment->user->name ?? 'Nepoznat korisnik' }}</td>
                <td>{{ $comment->product->name ?? 'Nepoznat proizvod' }}</td>
                <td>{{ $comment->title }}</td>
                <td>{!! Str::limit($comment->comment, 50) !!}</td>
                <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-primary btn-sm">Izmeni</a>
                    <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Da li si siguran da želiš da obrišeš ovaj komentar?')">Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#comments-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/sr-SP.json"
            }
        });
    });
</script>

@endsection
