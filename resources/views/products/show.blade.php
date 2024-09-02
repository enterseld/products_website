<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name_product }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div style="max-width: 800px; margin: auto; padding: 20px;">
        <h1>{{ $product->name_product }}</h1>
        
        @if($product->images->count())
            <div class="product-images" style="margin-bottom: 20px;">
                @foreach($product->images as $image)
                    <img src="{{ $image->picture }}" alt="{{ $product->name_product }}" style="width: 100%; max-width: 600px; height: auto; margin-bottom: 10px;">
                @endforeach
            </div>
        @endif

        <p>{{ $product->description }}</p>
        <p><strong>Price: ${{ $product->price }}</strong></p>

    </div>
</body>
</html>