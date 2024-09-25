@extends('layouts.app')

@section('content')
<div class="product-details">
    <h1>{{ $product->name_product }}</h1>
    <p><strong>Price:</strong> {{ $product->price }} {{ $product->currency_id }}</p>
    <p><strong>Description:</strong> {{ $product->product_description }}</p>
    <p><strong>Vendor:</strong> {{ $product->vendor }}</p>
    <p><strong>Available:</strong> {{ $product->available ? 'In Stock' : 'Out of Stock' }}</p>

    @if($product->images)
    <h2>Images:</h2>
    @foreach($product->images as $image)
        <img src="{{ $image->picture }}" alt="{{ $product->name_product }}" />
    @endforeach
@endif
</div>
@endsection
