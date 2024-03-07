
<h1>Formulář</h1>

<div id="alert"></div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Jméno
    <input name="name" type="text" class="grow" />
    </label>

</div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Pohlaví
    <input name="gender" type="text" class="grow" />
    </label>

</div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Email
    <input name="email" type="text" class="grow" />
    </label>

</div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Telefon
    <input name="phone" type="text" class="grow" />
    </label>

</div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Obrázek
    <input name="picture" type="text" class="grow" />
    </label>

</div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Název balíku
    <input name="deck_name" type="text" class="grow" />
    </label>

</div>

<div class="flex flex-row">

    <label class="input input-bordered flex items-center gap-2">
    Počet karet v balíku
    <input name="deck_count" type="text" class="grow" />
    </label>

</div>

<button class="btn"
        hx-post="/cv03/htmx/"
        hx-target="#alert"
        hx-swap="innerHTML"
        hx-include="[name='name'], [name='gender'], [name='email'], [name='phone'], [name='picture'], [name='deck_name'], [name='deck_count']"
>Odeslat</button>