@extends("base")

@section("content")
<div class="row mt-3 justify-content-center">
    <div class="col-4">
        <h1>Vytvořit spojení</h1>
        <form method="POST" action="/~boxd00/app/newconnection">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Číslo letu</label>
                    <input type="text" class="form-control" name="code">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Z</label>
                    <select class="form-select" name="from">
                        <option selected disabled></option>
                        @foreach ($groupedDestinations as $country => $destinations)
                        <optgroup label="{{ $country }}">
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->airport_code }}">{{ $destination->name }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label>Do</label>
                    <select class="form-select" name="to">
                        <option selected disabled></option>
                        @foreach ($groupedDestinations as $country => $destinations)
                        <optgroup label="{{ $country }}">
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->airport_code }}">{{ $destination->name }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label>Den</label>
                    <select class="form-select" name="day">
                        <option selected disabled></option>
                        <option value="1">pondělí</option>
                        <option value="2">úterý</option>
                        <option value="3">středa</option>
                        <option value="4">čtvrtek</option>
                        <option value="5">pátek</option>
                        <option value="6">sobota</option>
                        <option value="7">neděle</option>
                    </select>
                </div>
                <div class="col-6">
                    <label>Čas</label>
                    <input class="form-control" type="time" name="time">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="mt-3">
                        <label>Délka (min)</label>
                        <input class="form-control" type="number" name="duration" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mt-3">
                        <label>Cena</label>
                        <input class="form-control" type="number" name="price" required>
                    </div>
                </div>
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