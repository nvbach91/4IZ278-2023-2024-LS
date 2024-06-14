@extends("base")

@section("content")
<div class="row mt-3 justify-content-center">
    <div class="col-4">
        <h1>Vytvořit destinaci</h1>
        <form method="POST" action="/~boxd00/app/newdestination">
            @csrf
            <div class="mt-3">
                <label>Název</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="mt-3">
                <label>Kód letiště</label>
                <input class="form-control" type="text" name="code" required>
            </div>
            <div class="mt-3">
                <label>Stát</label>
                <input class="form-control" type="text" name="country" required>
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