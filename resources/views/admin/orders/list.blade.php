@extends('layouts.app')

@section('header')
    <h1>Lista porudžbina</h1>
@endsection

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<a href="{{ route('admin.orders.create') }}" class="btn btn-success w3-right mb-3">Dodaj novu porudzbinu</a>

<table id="orders-table" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Korisnik</th>
            <th>Proizvod</th>
            <th>Količina</th>
            <th>Poruka</th>
            <th>Datum</th>
            <th>Opcije</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->product->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{!! Str::limit($order->message, 50) !!}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Izmeni</a>
                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Da li si siguran da želiš da obrišeš ovu porudžbinu?')">Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/sr-SP.json"
            }
        });
    });
</script>

@endsection
