@extends("base")

@section("content")

@php
    use Carbon\Carbon;
    $days = ["pondělí", "úterý", "středa", "čtvrtek", "pátek", "sobota", "neděle"];
@endphp

<div class="row mt-3 justify-content-center">
    <div class="col-4">
        <h1>Vytvořit let</h1>
        <form method="POST" action="/~boxd00/app/newflight">
            @csrf
            <div class="mt-3">
                <label>Spojení</label>
                <select class="form-select" name="connection" required>
                    <option selected disabled></option>
                    @foreach ($connections as $connection)
                    <option value="{{ $connection->flight_code }}">
                        {{ $connection->flight_code }} ({{ $connection->from_destination->name }}-{{ $connection->to_destination->name }}, {{ $days[$connection->day-1] }} {{ Carbon::parse($connection->time)->format("H:i") }})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label>Datum</label>
                <input class="form-control" type="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Vytvořit</button>
        </form>
    </div>
</div>
@endsection

@section("misc_scripts")
@if (session("alert"))
<script type="text/javascript">
    alert("{{ session('alert') }}");
</script>
@endif
@endsection