@extends('layouts.app')

@section('content')
    <section class="center container">
        <img class="pageBanner" src="/shooper/themes/images/pageBanner.png" alt="New products">
        <h2 class="py-3"><span>Todas tu ordenes</span></h2>
    </section>

    <section class="container">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id de la orden</th>
                    <th># de Productos</th>
                    <th>Valor Total</th>
                    <th>Estado de pago</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td><a href="{{ route('order.show', $order, $order->user_id) }}">{{ $order->id }}</a></td>
                    <td>{{ $order->item_count }}</td>
                    <td>{{ $order->grand_total }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('order.delete', $order) }}" method="POST">
                            @CSRF @METHOD('DELETE')
                            <button>Eliminar</button>
                        </form></td>
            @empty
                Aún no tienes ordenes, sigue comprando
            @endforelse

            <tbody>
        </table>
    </section>
@endsection
