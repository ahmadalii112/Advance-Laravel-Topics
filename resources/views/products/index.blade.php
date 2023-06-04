<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stripe Payments</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>


</head>
<body>
<div style="display: flex; gap: 3rem">
    @foreach($products as $product)
        <div>
            <img src="{{ $product->image }}" alt="" style="max-width: 100%">
            <h5>{{ $product->name }}</h5>
            <p>${{ $product->price }}</p>
        </div>
    @endforeach
</div>
<div>
    <form action="{{ route('checkout') }}" method="post">
        @csrf
        <button>Checkout</button>
    </form>
</div>
</body>
</html>
