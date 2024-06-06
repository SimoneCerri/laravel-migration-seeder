# ! Quest ! #

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
- 🚨 WAIT TILL FINISH 🚨
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
    - foreach ($trains as $train) //loop with inside
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

### Resource Controller ###

- `php artisan make:controller --resource NomeController`
- CRUD: create, read, update, delete
    - GET
    - POST
    - PUT/PATCH
    - DELETE
- `Route::resource('nome',NomeController::class);`
- form: `action="{{route('users.store')}}"` `method="POST"` and `@csrf` inside (cross-site request forgery)
- inside public function store(Request $request)
    - code
- `php artisan make:model Nome -mcrs` model with:
    - migration
    - controller
    - resource
    - seeder
- `php artisan db:seed --class=NomeSeeder`
- php artisan vendor:publish
    - laravel-pagination

#### Again ####

- Again for posts page:
- file inside config with array called 'posts'
    - title, img, body
`php artisan make:model Post -mcrs`
- `web.php` -> Route::resource('/posts', PostController::class);
    - use App\Http\Controllers\PostController; in top of page
- `create_posts_table.php` (migration file)
    - $table->string('title',100);
    - etc etc
`PostSeeder.php`
    - public function run()
    - $posts = config('pasta.posts');
    - foreach ($posts as $post)
    {
        $newPost = new Post(); //**include file aswell**
        $newPost->title = $post['title']
        etc etc
        $newPost->save();
    }
- `php artisan migrate`
- `php artisan db:seed --class=PostSeeder`
- `PostController.php`
    - index()
        - return view('posts.index', ['posts'=> Post::orderByDesc('id')->paginate(8)]);
- folder posts
- `index.blade.php`
    - layout inside
    - `{{ $projects->links('pagination::bootstrap-5') }}`
- `php artisan vendor:publish`
- `PostController.php`
    - show(Post $post)
        - return view('posts.show',compact('post'));
- `show.blade.php`
    - layout inside
`index.blade.php`
    - button
- `PostController.php`
    - create()
        - return view('posts.create');
`create.blade.php`
    - layout
        - form
        - submit
`PostController.php`
    - store(Request $request)
    - $data = $resquest->all();
    - //possibility1
    - $post->title = $data['title']:
    - etc etc
    - $post->save();
    - //possibility2
    - //Post::create($data); ***DANGER*** have to modify Model
    - //Post.php -> inside class -> protected $fillable = ['title','img','body'];

## Authentication ##

- `composer create-project laravel/laravel:^10.0 nome-progetto`
- cd nome-progetto
- code .
- `composer require laravel/breeze --dev`
- `php artisan breeze:install`
    - blade
    - no
    - 1
- `composer require pacificdev/laravel_9_preset`
- `php artisan preset:ui bootstrap --auth`
- `vite.config.js` into `vite.config.cjs`
- `npp i`
- `npn run dev`
- `php artisan serve`
- `.env` file -> db name + root + root
- `php artisan migrate`
- `php artisan make:controller Admin/DashboardController`
- `DashboardController.php`
    - public function index()
    {
        return view('admin.dashboard');
    }
- `web.php`
    - Route::middleware(['auth','verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function()
    {
        //all route here that needs to be protected by our auth system
        Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    });
- update the constant used in `RouteServiceProvider.php`
    - public const HOME = '/admin';
- add `admin.blade.php` in layouts folder
    - copy original `app.blade.php`
- `dashboard.blade.php`
    - extend layout with the new admin.blade.php
- update the dropdown links in header for `admin.blade.php`
- `php artisan make:model Nome -mcrsR` or `php artisan make:model -a`
- migration file
    - $table->string('title',50);
    - $table->string('slug',50);
    - etc
    - etc
- seeder file -> use Faker\Generator as Faker; & use Illuminate\Support\Str; //faker for fake info and str for the slug
    - for loop with Faker
        - $item = new Nome();
        - $item->title = $faker->words(4,true);
        - $item->slug = Str::of($item->title)->slug('-');
        - etc
        - etc
        - $item->save();
- `DatabaseSeeder.php`
    - use Database\Seeders\NameSeeder;
    - $this->call(
        [
            NameSeeder::class
        ]);
- `php artisan migrate --seed` //migrate and seed
- `composer dump-autoload`
- `web.php`
    - route resource
- `NameController.php`
    - use Controller
    - inside middleware made before
        - Route::resource('name',NameController::class);
    - return view in controller (index)
- folder admin
    - folder posts
        - file `index.blade.php`
- extend layout, insert some markup
- `NameController`
    - show()
        - return view();
- add `show.blade.php` file
- extend layout, insert some markup

## File storage ##

- this will load img inside storage/app/public
- inside `filesystems.php`
    - change "local" into "public"
- inside `.env` under FILESTYSTEM_DISK
    - change "local" into "public"
- `php artisan storage:link`
- `php --ini`
    - configuration file (php.ini)
    - fileinfo
- add `enctype="multipart/form-data"` to the form in create & edit markup
    - inside use an input type file
- `StorePostRequest.php`
    - 'cover_image'=> 'nullable|image|max:500'
- `Controller.php`
    - inside store()
        - use Storage on top
        - if($request->has('cover_image')) //check if my request have a cover_image inside
        {
        $image_path = Storage::put('uploads',$validated['cover_image']); //take the path
        $validated['cover_image'] = $image_path //save the path for the validated data
        }
    - inside update()
    - if($request->has('cover_image'))
    {
        if($post->cover_image) //check if exist one before and delete it
        {
            Storage::delete($post->cover_image)
        }
        $image_path = Storage::put('uploads',$validated['cover_image']); //take the path
        $validated['cover_image'] = $image_path //save the path for the validated data
    }
    - inside destroy()
    - if($post->cover_image)
    {
        Storage::delete($post->cover_image)
    }
- to use it on a view for index/edit/show
```php
    @if(Str::startsWith($post->cover_image,'https://'))
        img src="{{post->cover_img}}"
    @else
        img src="{{asset('storage/'. $post->cover_img)}}"
    @endif
```
- //remember to don't use the old{{}} inside a value of img privacy-DANGER !
- img tag in markup pages
    - loading="lazy" for more fluid load in the network

## Table relationship ##

- `php artisan make:model Type -mscrR`
- migration file
    - public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }
- `TypeSeeder.php`
    - public function run(): void
    {
        $types = ['Html','Css','JavaScript','VueJS','ViteJS','PHP','Laravel','Bootstrap','Sass','Svelte'];
        foreach ($types as $type)
        {
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Str::slug($newType->name,'-');
            $newType->save();
        }
    }
- `DatabaseSeeder`
    - add TypeSeeder::class in $this->call([])
- `Type.php`
    - protected $fillable = ['name','slug'];
- `php artisan migrate --seed`
- `php artisan make:migration add_type_id_foreign_key_to_projects_table`
- migration file
    - method up
        - $table->unsignedBigInteger('type_id')->nullable()->after('id');
        - $table->foreign('type_id')
            ->references('id')
            ->on('types')
            ->onDelete('set null');
    - method down
        - $table->dropForeign('projects_type_id_foreign');
        - $table->dropColumn('type_id');
- `php artisan migrate`
- Model file
    - (one to many)
    - Project
        - add `type_id` inside fillable array
        - `use Illuminate\Database\Eloquent\Relations\BelongsTo;`
        /**
        * Get the type that owns the Project
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        - public function type(): BelongsTo
        {
            return $this->belongsTo(Type::class,);
        }
    - Type
        - `use Illuminate\Database\Eloquent\Relations\HasMany;`
        /**
         * Get all of the projects for the Type
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        - public function projects(): HasMany
        {
            return $this->hasMany(Project::class);
        }
- inside `create.blade.php` & `edit.blade.php`
```php
    <div class="mb-3 py-3">
        <label for="type_id" class="form-label">Type</label>
        <select class="form-select form-select-lg" name="type_id" id="type_id">
            <option selected disabled>Select one</option>
            @foreach ($types as $type)
                <option value="{{$type->id}}" {{$type->id == old('category_id',$project->type_id) ? 'selected' : '' }} >{{$type->name}}</option>
            @endforeach
        </select>
    </div>
```
- `StorePostRequest.php`
    - add 'category_id' => 'nullable|exist:categories,id'
- `PostController.php`
    - create()
        - $categories = Category::all();
        - compact('categories')
    - edit()

## Repo-Template ##

- create a laravel project
- install bootstrap + breeze + others
- create a base markup (example with admin/auth/dashboard/partials/etc etc)
- create a repo on GitHub
- set it as template for next projects in settings
- on VSC git clone + repo-template-link + project-name
- cd project-name
- code .
- .env.example into .env
- composer i
- php artisan key:generate
- npm i
- npm run dev
- php artisan serve

## Vue-Vite & Vue-Router ##

php artisan make:controller Api/ProjectController
api.php
    Route::get('projects',[ProjectController::class,'index']);
inside Api/ProjectController.php
    index
        $projects = Project::with('technologies', 'type')->paginate(5); //care to pass correct name inside with()
        return response()->json([
            'projects' => $projects,
        ]);

inside new project for the front-end
npm create vite@latest .  -- --template vue
npm install vue-router@4
npm i axios
router.js
    import { createWebHistory, createRouter } from 'vue-router';
    import AppHome from "./pages/AppHome.vue";
    import AppProjects from "./pages/AppProjects.vue";

    const router = createRouter({
    history: createWebHistory(),
    routes:
        [
            {
                path: '/',
                name: 'home',
                component: AppHome,
            },
            {
                path: '/projects',
                name: 'projects',
                component: AppProjects,
            },
        ]
    })
    export default router;
main.js
    import router from './router.js'
    .use(router) -> to createApp(App)
App.vue
    import axios from 'axios';
    data()
    {
        return{
            projects:[]
        }
    }
    mounted()
    {
        axios.get(url).then(response => {this.projects = response.data}).catch(err =>{error.message})
    }

404 if/else in ProjectController
router.js -> path/name etc
componentError with error message or something
AppProjects.vue
if (response.data.success) {
    //console.log(response.data.projects);
    this.projects = response.data.projects;
}
else {
    this.$router.push({ name: 'not-found' });
}

## Email ##

php artisan make:mail NewLeadMessage
php artisan make:mail NewLeadMessage -m
NewLeadMessage.php
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            subject: 'Order Shipped',
        );
    }
    change the returned view aswell
mail.php if you want to clear code and every mail come to a same mail
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],
create the view inside resources/views/mail -> new-lead-message.blade.php
.env

Api/Controller -m
route with controller store
Api/LeadController.php
    store

CORS -> .env -> config/cors.php

## Off recording ##

gemini ai artisan
composer require pacificdev/terminal-assistant:^0.2.0 -> per laravel 10x
composer update
more commands..
.env ->
artisan pacificdev:ask
question
 