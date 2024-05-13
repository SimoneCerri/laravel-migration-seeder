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
4. Aggiungiamo un seeder per la classe Train usando un array di dati fittizzi fatta a mano.

## BONUS: ##
- Implementare il seeder tramite FakerPHP

## Steps ##

- create a laravel project `composer create-project laravel/laravel:^10.0 laravel-migration-seeder`
- WAIT TILL FINISH
- cd laravel-migration-seeder
- code .
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
- create the table `php artisan make:migration create_trains_table`
- migrate the table to DB `php artisan migrate` -> yes (if DB doesn't exist and want to create it)
- to go back `php artisan migrate:rollback` -> we need to implement some columns
- can also do one by one php artisan `make:migration add_company_to_trains_table`
    - then insert in the new file created inside function up `$table->string('company', 20)->after('id');`
    - inside function down `$table->dropColumn('company');`
- or `php artisan make:migration update_trains_table --table=trains` as well
- trains table columns
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
- migrate all the changes `php artisan migrate`
- create a model for the single train `php artisan make:model Train`
- use the tinker `php artisan ti`
- specify the route `App\Models\Train::all()`
- `$train = new App\Models\Train()`
- `$train->company = 'Trenitalia'` ->give company
- `$train->train_code = 'PS0001'` ->give code
- `$train->cancelled = 0` ->give
- `$train->departure_station = 'Pisa Centrale'` ->give dep station
- `$train->arrival_station = 'Viareggio'` ->give arr station
- `$train->save()`-> true -> corrected save
- `$train` -> show the new train with all the data insert
- `exit`
- create a controller and directly link the Model with -m Train `php artisan make:controller Guests/TrainController -m Train`
- create routes in `web.php` using the controllers for:
    - page /trains
    - page /trains{train}
- modify `TrainController.php` inside function index
    - `$trains = Train::orderByDesc('id')->get();`
    - `return view('guests.trains.index', compact('trains'));`
    - create train folder inside guests folder and put `index.blade.php`
    - extends layout etc etc
- modify `TrainController.php` inside function show
    - `return view('guests.trains.show', compact('train'));`
    - put `show.blade.php` inside /views/guests/trains
    - extends layout etc etc
- make some markup for:
    - header
    - footer
- link routes as well on nav for point the pages you create
- create a seeder `php artisan make:seeder TrainsTableSeeder`
- inside run function in `TrainsTableSeeder.php`
    - `use App\Models\Train;`
    - `$trains = config('db.trains')` where i put that array
    return = 
    [   
        'trains' =>
        [
            [
                'key' => 'value',
                'key' => 'value',
                'key' => 'value',
                'key' => 'value',
            ],
            [
                'key' => 'value',
                'key' => 'value',
                'key' => 'value',
                'key' => 'value',
            ],
        ];
    ];
    - foreach ($trains as $train) loop with inside
        - $newTrain = new Train();
        - $newTrain->company = $train['company'];
        - etc etc for all the variables
        - %newTrain->save(); ***<--IMPORTANT***
- `php artisan db:seed --class=TrainsTableSeeder`
- or we can use Faker:
    - `use Faker\Generator as Faker;` inside file `TrainsTableSeeder.php`
    - inside function run(Faker $faker)
        - for loop
            - $train = new Train();
            - $train->company = $faker->bothify('');
            - etc etc
            - $train->save(); ***<--IMPORTANT***
- `php artisan db:seed --class=TrainsTableSeeder`