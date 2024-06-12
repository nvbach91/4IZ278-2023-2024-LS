# Systém internetového bankovnictví s imaginární měnou
Webová aplikace bude sloužit jako systém internetového bankovnictví, do kterého se uživatelé mohou registrovat. Při **registraci** je uživateli zřízen bankovní účet, ze kterého může **příjmat** a **odesílat** platby.  Uživatelé si po **přihlášení** také mohou **zakládat** ve svém profilu **nové** bankovní **účty**. V základním přehledu si přihlášený uživatel může také **zobrazit aktuální zůstatek** svých účtů.  V **detailu účtů** může také **nastavit**, kteří uživatelé mají k tomuto **účtu přístup**.

## Výčet stránek
### Registrace
Na této stránce se uživatelé mohou registrovat buď zadáním emailu, jména a hesla, nebo přes facebookový účet.
### Přihlášení
Zde se registrovaní uživatelé mohou přihlásit buď zadáním emailu + hesla, nebo facebookovým účtem.
### Základní přehled
Zde uživatelé po přihlášení vidí seznam účtů, ke kterým mají oprávnění, a jejich účetní zůstatky.
#### Wireframe:
![obrazek](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/60074633/a9df1ab1-dda5-4258-8377-cb417fc0a451)
### Detail účtu
Tady může uživatel vidět informace o účtu, ke kterému má oprávnění, jeho zůstatek, detaily o transakcích na tomto účtu a může spravovat, kteří uživatelé k tomuto účtu mají také přístup.
#### Wireframe:
![obrazek](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/60074633/1c5c5eb9-3db0-4587-b452-369b96b18dd7)

### Odeslání platby
Z této stránky lze zadat platbu z konkrétního účtu (ke kterému má uživatel přístup) na jiný účet. K platbě lze také volitelně přidat textovou zprávu
### Profil
Slouží k zobrazení a případné úpravě informací o uživateli.

## Architektura
- Webový server: Apache
- Back-end:  Php 8+, Laravel 10 (protože na eso.vse.cz je php 8.1.20), Laravel Livewire
- Databáze: MySQL
- Návrhový vzor: Lehce upravený vzor MVC kvůli využití frameworku Livewire, který přenáší část odpovědosti z Controlleru do Livewire komponenty
- Front-end: HTML + Tailwindcss, Laravel Livewire
- Způsob komunikace mezi databází, serverem a klientem: Standardní MVC přístup pod frameworkem Laravel

## Návrh databáze
![obrazek](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/60074633/cf11f606-bb03-4e05-aff3-30f8eef50b85)

[https://dbdiagram.io/d/System-internetoveho-bankovnictvi-6625351f03593b6b618de0ac](https://dbdiagram.io/d/System-internetoveho-bankovnictvi-6625351f03593b6b618de0ac)
```
Table accounts {
  id integer [primary key]
  display_name varchar
  created_at timestamp
  balance decimal
}

Table users {
  id integer [primary key]
  name varchar
  email varchar
  password varchar
  created_at timestamp
}

Table transactions {
  id integer [primary key]
  amount decimal
  from_account integer
  target_account integer
  sent_by integer
  sent_at timestamp
  message varchar [null]
}

Table account_permissions {
  account_id integer [primary key]
  user_id integer [primary key]
  permission_type enum
}


Ref: account_permissions.account_id > accounts.id
Ref: account_permissions.user_id > users.id
Ref: transactions.from_account > accounts.id
Ref: transactions.target_account > accounts.id
Ref: transactions.sent_by > users.id

```
## Use case diagram
![obrazek](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/60074633/2761204a-0015-4d8e-92e5-d150820f15e6)
[http://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000](http://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000)
```
@startuml
left to right direction
skinparam packageStyle rectangle
actor Uživatel as user
package "Nepřihlášený Uživatel" {
  (Registrace) as (UC1)
  (Přihlášení) as (UC2)
  user -- (UC1)
  user -- (UC2)
}

package "Přihlášený Uživatel" {
  (Vytvoření bankovního účtu) as (UC3)
  (Zobrazení zůstatků) as (UC4)
  (Správa přístupu k účtu) as (UC5)
  (Odeslání platby) as (UC6)
  (Zobrazení detailů účtu) as (UC7)
  (Úprava uživatelského profilu) as (UC8)

  user -- (UC3)
  user -- (UC4)
  user -- (UC5)
  user -- (UC6)
  user -- (UC7)
  user -- (UC8)
}

@enduml
```

## Sekvenční diagram pro odeslání platby uživatelem
![obrazek](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/60074633/8baaac78-f1c1-4965-b67d-a34aec227744)
[http://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000](http://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000)
```
@startuml
actor Uživatel as user
participant "Webové Rozhraní" as web
participant Server
participant Databáze as db

user -> web : Přihlásí se a zvolí odeslání platby
web -> Server : Požadavek na formulář pro platbu
Server -> user : Zobrazí formulář pro zadání detailů platby
user -> Server : Odeslání vyplněného formuláře
Server -> db : Ověření zůstatku a validitu účtu
db -> Server : Potvrzení možnosti transakce
Server -> db : Provedení transakce
db -> Server : Potvrzení provedené transakce
Server -> web : Informace o úspěšné transakci
web -> user : Zobrazení potvrzení uživateli
@enduml

```

## Procesní diagram pro odeslání platby uživatelem
![obrazek](https://github.com/nvbach91/4IZ278-2023-2024-LS/assets/60074633/24739ee6-9e89-4a27-940f-c96b4f386ba8)
[http://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000](http://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000)
```
@startuml
start
:Uživatel se přihlásí do systému;
:Uživatel zvolí odeslat platbu;
:Vyplnění detailů platby;
:Ověření údajů systémem;
:Provedení transakce;
:Uživatel obdrží potvrzení o transakci;
stop
@enduml
```
## Checklist
| Kategorie                  | Požadavek                                       | splnění | spolehlivost | komentář |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Databáze                   | M:N vztahy                                      |     X    |              |          |
|                            | 1:N vztahy                                      |    X     |              |          |
|                            | SQL joins                                       |     X    |              | Pokud by se nejednalo o porušení pravidel této práce, rád bych využil Eloquent ORM, který je součástí frameworku Laravel         | 
|                            | Integritní omezení                              |  X       |              |          |
|                            | Testovací data                                  |   X      |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Validace a sanitace vstupů | Formuláře                                       |    X     |              |          |
|                            | Datové typy                                     |     X    |              |          |
|                            | Regulární výrazy                                |         |              |          |
|                            | Serverová validace požadavků                    |    X     |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Psaní kódu                 | Potlačení warningů - nedefinované hodnoty       |     X    |              |          |
|                            | Formátování kódu                                |    X     |              |          |
|                            | DRY princip - minimalizace opakování kódu       |     X    |              |          |
|                            | SRP princip - single responsibility             |   X      |              |          |
|                            | Pojmenování proměnných                          |   X      |              |          |
|                            | Konzistence stylu psaní kódu                    |    X     |              |          |
|                            | Verzování kódu (Git)                            |    X     |              |          |
|                            | HTML5 validní + sémantické značky               |     X    |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Objektové programování     | Zapouzdření                                     |         |              |          |
|                            | Dědičnost                                       |    X     |              |          |
|                            | Abstrakce                                       |   X      |              |          |
|                            | Rozhraní                                        |         |              |          |
|                            | Polymorfismus                                   |         |              |          |
|                            | Magické metody                                  |   X      |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Připojení k databázi       | PDO                                             |         |              |          |
|                            | Prepared statement                              |         |              |          |
|                            | SQL injection                                   |    X     |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Performance                | Stránkování                                     |         |              |          |
|                            | Indexace databázových tabulek                   |         |              |          |
|                            | Filtrace a organizování zdrojů                  |         |              |          |
|                            | Cache (mezipaměť)                               |         |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Autentifikace              | Cookies                                         |         |              |          |
|                            | Session                                         |    X     |              |          |
|                            | Lokální strategie pro registraci a   přihlášení |   X      |              |          |
|                            | OAuth, access token, login                      |    X     |              |          |
|                            | Ukládánní hesel                                 |         |              |          |
|                            | Uživatelská oprávnění                           |     X    |              |          |
|                            | Uživatelské role                                |         |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Datum a čas                | Časové pásmo                                    |     X    |              |          |
|                            | Formátování časových hodnot                     |    X     |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Návrhové vzory             | Model                                           |    X     |              |          |
|                            | View                                            |     X    |              |          |
|                            | Controller                                      |    X     |              |   Mírně upravené jejich využití kvůli Laravel Livewire komponentám       |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Bezpečnost                 | XSS                                             |   X      |              |          |
|                            | CSRF                                            |    X     |              |          |
|                            | SQL injection                                   |     X    |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| API                        | CRUD operace                                    |   X      |              |          |
|                            | HTTP metody                                     |      X   |              |          |
|                            | Sémantické pojmenování zdrojů                   |   X      |              |          |
|                            | Verzování                                       |         |              |          |
|                            | Idempotence                                     |    X     |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Provoz a údržba            | Sledovatelnost a logování                       |         |              |          |
|                            | SEO URL                                         |    X     |              |          |
|                            | Víceuživatelský přístup k datům                 |      X   |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Funkcionality              | Generování souborů PDF                          |         |              |          |
|                            | Posílání e-mailů                                |    X     |              |          |
|                            | Oddělení ddministrační a uživatelské části      |         |              |          |
|----------------------------|-------------------------------------------------|---------|--------------|----------|
| Testování                  | Testovací scénáře pro manuální testování        |         |              |          |
|                            | Dostupnost aplikace na internetu                |     X    |              |          |


