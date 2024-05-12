# TODO

Položky pouze přidávám a odebírám, nevedu historii splnění.

### Velká změna DB (napsat učitelovi?)

- přepsat email na email
- všude přidány PKs

### Kritické

- všude přidat oprávnění pro uživatele
- kontrola, že délka všech stringů do db má max 255 znaků
- do edit org přidat kontrolu vstupů
- pokud je přihlášený producent, měl by se automaticky vyplnit do producent pole
- validace v create a edit můžou být na jednom místě kvůli DRY
- někde se používá **DIR**, někde ne
- pokud se neprovede žádná změna, nemělo by být upravit klienta tlačítko clickable
- otestovat, že funguje mailing
- až budou implementované všechny classes, nemusím requirovat db v normálních files
- řazení uživatelů by mělo být admin > producent > klient
- administrátorovi se musí vypsat úplně všechny skladby
