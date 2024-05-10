# !Quest! #

1. Creiamo una tabella trains e relativa Migration
 - Ogni treno dovrà avere almeno:
    - id
    - Azienda
    - Stazione di partenza
    - Stazione di arrivo
    - Orario di partenza
    - Orario di arrivo
    - Codice Treno
    - Numero Carrozze
    - In orario
    - Cancellato

2. Inserite inizialmente i dati tramite PhpMyAdmin o artisan tinker per chi ne ha capito l'utilizzo.
3. Create il modello Model relativo alla migrazione che avete predisposto al fine di mappare la tabelle del db ed un Controller per mostrare nella home page tutti i treni che sono in partenza dalla data odierna.

## Steps ##

- `composer create-project laravel/laravel:^10.0 laravel-migration-seeder`
- `composer require pacificdev/laravel_9_preset`
- `php artisan preset:ui bootstrap`
- rename `vite.config.js` into `vite.config.cjs`
- `npm i` (Bash#1)
- `npm run dev` (Bash#1)
- `php artisan serve` (Bash#2)
- folders `guests`,`layouts`,`partials` into `views` folder
- `app.blade.php` into layouts -> base html with yield for page-title and page-main
- `home.blade.php` into guests -> extends layouts.app and section for page-title and page-main
- `header.blade.php` and footer.blade.php into partials -> some basic html for both
- create a DB into phpMyAdmin
- modify `.env` file with mysql infos
- `php artisan make:migration create_trains_table`
- `php artisan migrate` -> yes (if not exist and want to create it)
- `php artisan migrate:rollback` -> we need to implement some columns
- can also do one by one php artisan `make:migration add_company_to_trains_table`
    - then insert in the new file created inside function up `$table->string('company', 20)->after('id');`
    - inside function down `$table->dropColumn('company');`
- trains table column
    - id BIGINT AI PK UQ
    - company VARCHAR(20) NOTNULL
    - departure_station VARCHAR(50)
    - arrival_station VARCHAR(50)
    - departure_time DATETIME
    - arrival_time DATETIME
    - train_code VARCHAR(10) NOTNULL
    - number_of_carriages TINYINT
    - on_time TINYINT
    - cancelled BOOLEAN
    - created_at DATETIME
    - update_at DATETIME
- `php artisan migrate`