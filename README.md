# Konyvtari kolcsonzes API (Laravel)

A masodik feladat Laravel REST API megvalositasa. Az API mezoi snake_case alakban szerepelnek (`kiadas_eve`, `olvaso_id`).

## Inditas

```sh
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed
php artisan serve
```

Alap URL: `http://127.0.0.1:8000/api`.

## Vegpontok

- `GET|POST /olvasok`, `GET|PUT|DELETE /olvasok/{id}`
- `GET /olvasok/{id}/konyvek`, `GET /olvasok/kolcsonzok`
- `GET|POST /konyvek`, `GET|PUT|DELETE /konyvek/{id}`
- `GET /konyvek/szabad`, `GET /konyvek/kereses?szoveg=...`

Az olvaso JSON: `{"nev":"...","email":"..."}`. A konyv JSON: `{"cim":"...","szerzo":"...","isbn":"...","kiadas_eve":2020,"olvaso_id":null}`. Kikolcsonzeshez adj meg meglevo `olvaso_id`-t, visszahozashoz `null`-t. A masik olvasohoz atadas csak visszahozas utan engedett. Hibasan megadott mezok es duplikalt ISBN/email eseten Laravel 422 JSON valaszt ad; a nem letezo rekord 404.
