@extends('layouts.app')

@section('content')
<h1>Product Categories</h1>

<div class="categories">
    @foreach($categories as $categoryName => $products)
        <div class="category-card">
            <h2>{{ $categoryName }} </h2>
            @foreach($products as $product)
                <div class="product-item">
                    <h3>{{ $product->name_product }}</h3>
                    <p>Price: {{ $product->price }} {{ $product->currency_id }}</p>
                    @if($product->images && isset($product->images[0]))
                        <img src="{{ $product->images[0]->picture }}" alt="{{ $product->name_product }}">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
