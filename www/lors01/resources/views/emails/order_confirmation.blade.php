<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Potvrzení objednávky</title>
</head>
<body>
    <h1>Potvrzení objednávky</h1>
    <p>Děkujeme za Vaši objednávku!</p>

    <h2>Detaily objednávky</h2>
    <p>ID objednávky: {{ $order->id }}</p>
    <p>Celková cena: {{ $order->total_price }}</p>

    <h2>Doručovací údaje</h2>
    <p>Adresa: {{ $order->address }}</p>
    <p>Město: {{ $order->city }}</p>

    <h2>Položky objednávky</h2>
    <ul>
        @foreach ($order->products as $product)
            <li>{{ $product->name }} x {{ $product->pivot->quantity }}</li>
        @endforeach
    </ul>
</body>
</html>
