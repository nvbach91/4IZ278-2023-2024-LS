## Semestrální práce - Komunitní hlídání koček
Stránka má za cíl propojit zájemce o hlídání koček s těmi, co zrovna hlídání svých mazlíčků potřebují. Narozdíl od jiných webů zde služby nenabízí firmy, ale jednotlivci v okolí se zájmem a zkušenostmi s péčí o zvířata.

### Popis funkcionalit
1. **Přihlášení uživatele** - možnost přihlásit se do aplikace, pro přistup k svému profilu a interakci s funkcemi aplikace.
2. **Registrace uživatele** - možnost zaregistrovat se do aplikace pro nové uživatele.
3. **Správa uživatelského profilu** - změna osobních údajů nebo hesla.
4. **Přidání kočky** - majitelé koček mají možnost přidat své kočky do profilu s informacemi např. o věku, povaze a omezeních. Ke kočce je možné přiložit fotografie.
5. **Úprava údajů o kočkách** - aby byly údaje vždy aktuální.
6. **Procházení hlídačů** - prohlížení dostupných hlídačů.
7. **Nastavení dostupnosti hlídače** - hlídač si může v profilu nastavit které dny a ve které časy je dostupný.
8. **Vložení nového hlídání** - majitel podá žádost, hlídač potvrdí.
9. **Smazání termínu hlídání** - může majitel i hlídač do 24 hodin před začátkem.
10. **Hodnocení** - po proběhlém hlídání jsou majitel a hlídač vyzváni k vzájemnému hodnocení.
11. **Správcovské rozhraní** - mazání nevhodných profilů nebo jejich částí (majitelé, hlídači i kočky) a hodnocení, úprava rezervací.

### Usecase diagram
![usecase_diagram](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/99769575/1851478e-af26-45df-a806-33374fe9318c)

### Výčet stránek
Autentizace:
- Přihlášení
- Registrace
- "Zapomenuté heslo?"
- Zadání nového hesla při obnově

Vkládání obsahu:
- Správa uživatelského profilu
- Správa kočičího profilu 
- Nastavení dostupnosti hlídače
- Žádost o hlídání
- Správa termínů hlídání
- Vložit hodnocení

Procházení obsahu:
- Procházení nabídek hlídání (dostupné i bez registrace)
- Detail hlídače 
- Detail profilu majitele & koček
- Historie hlídání

Správce:
- Přehled nových uživatelů, nových koček, nově vložených hodnocení
- Vyhledání uživatele
- Přehled všech hlídání na profilu uživatele
- Tlačítka úpravy/smazání u každé entity

### Návrh databáze
![db_diagram](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/99769575/b71c59b5-6b3b-425d-9ff0-d23d2a82e69a)

<!--
Table users {
  id int [primary key]
  role int
  name varchar
  email varchar [ref: - password_reset_tokens.email]
  email_verified_at timestamp
  password varchar
  location varchar
  photo_url varchar
  remember_token varchar
  created_at timestamp
  updated_at timestamp
}

Table password_reset_tokens {
  email varchar [primary key]
  token varchar
  created_at timestamp
}

Table cats {
  id int [primary key]
  owner_id int [ref: > users.id]
  name varchar
  birthday date
  details varchar
  photo_url varchar
  created_at timestamp
  updated_at timestamp
}

Table available_times {
  id int [primary key]
  sitter_id int [ref: > users.id]
  rfc5545_str varchar
  created_at timestamp
  updated_at timestamp
}

Table sittings {
  id int [primary key]
  owner_id int [ref: > users.id]
  sitter_id int [ref: > users.id]
  start_time timestamp
  end_time timestamp
  status enum
  created_at timestamp
  updated_at timestamp
}

Table reviews {
  id int [primary key]
  sitting_id int [ref: - sittings.id]
  review_of_owner varchar
  score_of_owner int
  review_of_sitter varchar
  score_of_sitter int
  created_at timestamp
  updated_at timestamp
}
-->

### Sekvenční diagram
#### Z pohledu majitele
1. Majitel kočky/koček se zaregistruje.
2. Majitel se přihlásí a vyplní svůj profil.
3. Majitel vyplní informace o svých kočkách.
4. Majitel plánuje jet na dovolenou. Přihlásí se na web, vybere si hlídače podle hodnocení a časové i geografické dostupnosti. V kalendáři vybere termín a podá žádost o hlídání.
5. Hlídání je potvrzeno nebo zamítnuto hlídačem. Další komunikace probíhá e-mailem. 
6. *Probíhá hlídání koček*
7. Majitel se vrací z dovolené. Po skončení termínu hlídání je vyzván k ohodnocení hlídače.
8. Napíše hodnocení hlídače.
9. Poté, co hodnocení napíše i hlídač, se obě zveřejní na webu.

#### Z pohledu hlídače
1. Hlídač se zaregistruje.
2. Hlídač se přihlásí a vyplní svůj profil.
3. Hlídač navíc vyplní podrobnější informace o dostupnosti.
4. Hlídači přijde e-mail o zájmu majitele, v systému nabídku potvrdí nebo odmítne. Další komunikace probíhá e-mailem.
5. *Probíhá hlídání koček*
6. Po skončení hlídání je vyzván k ohodnocení majitele.
7. Napíše hodnocení majitele.
8. Poté, co hodnocení napíše i majitel, se obě zveřejní na webu.

### Architektura
- **Webový server:** Apache
- **Back-end:** PHP 8+, Laravel framework
- **Databáze:** MariaDB
- **Návrhový vzor:** MVC
- **Front-end:** HTML5, CSS, JavaScript, Bootstrap
- **Komunikace mezi databází a serverem:** SQL - Laravel DB Facade

### Checklist
| Kategorie                  | Požadavek                                       | splnění | spolehlivost | komentář |
|----------------------------|-------------------------------------------------|:-------:|--------------|----------|
| Databáze                   | M:N vztahy                                      | x       |              |          |
|                            | 1:N vztahy                                      | x       |              |          |
|                            | SQL joins                                       | x       |              |          |
|                            | Integritní omezení                              | x       |              |          |
|                            | Testovací data                                  |         |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Validace a sanitace vstupů | Formuláře                                       | x       |              |          |
|                            | Datové typy                                     | x       |              |          |
|                            | Regulární výrazy                                | x       |              |          |
|                            | Serverová validace požadavků                    | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Psaní kódu                 | Potlačení warningů - nedefinované hodnoty       | x       |              |          |
|                            | Formátování kódu                                | x       |              |          |
|                            | DRY princip - minimalizace opakování kódu       | x       |              |          |
|                            | SRP princip - single responsibility             | x       |              |          |
|                            | Pojmenování proměnných                          | x       |              |          |
|                            | Konzistence stylu psaní kódu                    | x       |              |          |
|                            | Verzování kódu (Git)                            | x       |              |          |
|                            | HTML5 validní + sémantické značky               | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Objektové programování     | Zapouzdření                                     | x       |              |          |
|                            | Dědičnost                                       | x       |              |          |
|                            | Abstrakce                                       | x       |              |          |
|                            | Rozhraní                                        | x       |              |          |
|                            | Polymorfismus                                   | x       |              |          |
|                            | Magické metody                                  | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Připojení k databázi       | PDO                                             | x       |              |          |
|                            | Prepared statement                              | x       |              |          |
|                            | SQL injection                                   | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Performance                | Stránkování                                     | x       |              |          |
|                            | Indexace databázových tabulek                   |         |              |          |
|                            | Filtrace a organizování zdrojů                  | x       |              |          |
|                            | Cache (mezipaměť)                               |         |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Autentifikace              | Cookies                                         | x       |              |          |
|                            | Session                                         | x       |              |          |
|                            | Lokální strategie pro registraci a přihlášení   | x       |              |          |
|                            | OAuth, access token, login                      |         |              |          |
|                            | Ukládání hesel                                  | x       |              |          |
|                            | Uživatelská oprávnění                           | x       |              |          |
|                            | Uživatelské role                                | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Datum a čas                | Časové pásmo                                    | x       |              |          |
|                            | Formátování časových hodnot                     | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Návrhové vzory             | Model                                           | x       |              |          |
|                            | View                                            | x       |              |          |
|                            | Controller                                      | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Bezpečnost                 | XSS                                             | x       |              |          |
|                            | CSRF                                            | x       |              |          |
|                            | SQL injection                                   | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| API                        | CRUD operace                                    |         |              |          |
|                            | HTTP metody                                     |         |              |          |
|                            | Sémantické pojmenování zdrojů                   |         |              |          |
|                            | Verzování                                       |         |              |          |
|                            | Idempotence                                     |         |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Provoz a údržba            | Sledovatelnost a logování                       |         |              |          |
|                            | SEO URL                                         |         |              |          |
|                            | Víceuživatelský přístup k datům                 | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Funkcionality              | Generování souborů PDF                          |         |              |          |
|                            | Posílání e-mailů                                | x       |              |          |
|                            | Oddělení ddministrační a uživatelské části      | x       |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Testování                  | Testovací scénáře pro manuální testování        |         |              |          |
|                            | Dostupnost aplikace na internetu                | x       |              |          |