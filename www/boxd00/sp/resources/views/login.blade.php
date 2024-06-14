@extends("base")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="container mt-3">
                @if (session("status") == "registered")
                    <p class="successText" id="registeredAlert">Účet byl úspěšně zaregistrován! Nyní se můžete přihlásit.</p>
                @endif
                <h1 id="loginFormName">Přihlášení</h1>
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if (session("error"))
                    <div class="alert alert-danger">
                        {{ session("error") }}
                    </div>
                @endif
                <form method="POST" action="/~boxd00/app/login" id="loginForm">
                    @csrf
                    <div class="mt-3">
                        <label for="email">E-mailová adresa</label>
                        <input type="email" class="form-control" name="email" id="loginEmail">
                    </div>
                    <div class="mt-3">
                        <label for="password">Heslo</label>
                        <input type="password" class="form-control" name="password" id="loginPassword">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" id="loginButton" disabled>Přihlásit se</button>
                    </div>
                </form>
                <form method="POST" action="/~boxd00/app/register" id="registerForm">
                    @csrf
                    <div class="mt-3">
                        <label for="email">E-mailová adresa</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mt-3">
                        <label for="password">Heslo</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <p class="errorText" id="shortPasswordAlert">Heslo musí obsahovat alespoň 8 znaků.</p>
                    <div class="mt-3">
                        <label for="confirmPassword">Potvrdit heslo</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                    </div>
                    <p class="errorText" id="equalPasswordAlert">Hesla se musejí rovnat.</p>
                    <div class="mt-3">
                        <label for="firstName">Křestní jméno</label>
                        <input type="text" class="form-control" name="firstName" id="firstName">
                    </div>
                    <div class="mt-3">
                        <label for="lastName">Příjmení</label>
                        <input type="text" class="form-control" name="lastName" id="lastName">
                    </div>
                    <div class="mt-3">
                        <label for="birthDate">Datum narození</label>
                        <input type="date" class="form-control" name="birthDate" id="birthDate">
                    </div>
                    <p class="errorText" id="ageAlert">Pro vytvoření účtu vám musí být alespoň 18 let.</p>
                    <div class="mt-3">
                        <label for="phone">Telefonní číslo</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <p class="errorText" id="phoneAlert">Telefonní číslo musí být platné.</p>
                    <div class="mt-3" id="isStudentRow">
                        <input type="checkbox" name="isStudent" id="isStudent">
                        <label>Jsem student</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" id="registerButton" disabled>Zaregistrovat se</button>
                    </div>
                </form>
                <p id="registerLink" class="mt-3">Nemáte účet? Zaregistrujte se <a href="#">zde</a>.</p>
                <p id="loginLink" class="mt-3">Již máte účet? Přihlaste se <a href="#">zde</a>.</p>
            </div>
        </div>
    </div>
</div>
@endsection