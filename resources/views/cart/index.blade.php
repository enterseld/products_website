.@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <h1>Your Cart</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $vendor_code => $item)
                    <tr>
                        <td>
                            <img src="{{ $item['picture'] }}" alt="{{ $item['name'] }}" style="width: 100px;">
                            <p>{{ $item['name'] }}</p>
                        </td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>${{ $item['price'] * $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $vendor_code) }}" method="POST">
                                @csrf
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total: ${{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}</strong></p>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection
