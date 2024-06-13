@extends("base")

@section("content")
<div class="row">
    <div class="col">
        <div class="container mt-3">
            <h1>Destinace</h1>
            <p>S BlueJet se můžete proletět do těchto destinací:</p>
            @foreach ($groupedDestinations as $country => $destinations)
                <h2>{{ $country }}</h2>
                <ul>
                    @foreach ($destinations as $destination)
                        <li>{{ $destination->name }}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
@endsection