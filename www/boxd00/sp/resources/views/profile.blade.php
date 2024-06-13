@extends("base")

@section("content")
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-4">
            <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
            @if (session("success"))
                <div class="alert alert-success">{{ session("success") }}</div>
            @endif
            @if (session("error"))
                <div class="alert alert-success">{{ session("error") }}</div>
            @endif
            <form method="PUT" action="{{ route('profile') }}" id="updateUserForm">
                @csrf
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="updateEmail" required>
                    <p class="errorText" id="emailAlert">E-mailová adresa je neplatná.</p>
                </div>
                <div class="form-group mt-2">
                    <label>Původní heslo</label>
                    <input type="password" class="form-control" name="oldPassword" id="oldPassword">
                    <p class="errorText" id="oldAlert">Musíte zadat staré heslo.</p>
                </div>
                <div class="form-group mt-2">
                    <label>Nové heslo</label>
                    <input type="password" class="form-control" name="password" id="updatePassword">
                    <p class="errorText" id="passAlert">Heslo musí mít minimálně 8 znaků.</p>
                </div>
                <div class="form-group mt-2">
                    <label>Potvrdit heslo</label>
                    <input type="password" class="form-control" name="confirm" id="updateConfirm">
                    <p class="errorText" id="confirmAlert">Hesla se musí shodovat.</p>
                </div>
                <div class="form-group mt-2">
                    <label>Telefonní číslo</label>
                    <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}" id="updatePhone" required>
                    <p class="errorText" id="phoneAlert">Telefonní číslo je neplatné.</p>
                </div>
                <button type="submit" class="btn btn-primary mt-3" id="updateButton" disabled>Potvrdit</button>
            </form>
        </div>
    </div>
</div>
@endsection