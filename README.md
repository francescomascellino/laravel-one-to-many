<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## CLONARE UNA REPO DA GITHUB

CREARE LA NUOVA REPO
COPIARE IL LINK DAL DROPDOWN ***CODE*** DA GitHub
ESEGUIRE
```bash
git clone [LINK CLONAZIONE COPIATO] [NOME DIRECTORY DI DESTINAZIONE]
```
ES:
```bash
git clone https://github.com/francescomascellino/laravel-auth.git laravel-one-to-many
```

ELIMINARE LA CARTELLA .git
```bash
rm -rf .git
```

INIZIALIZZARE E COMMITTARE
```bash
git init
git add .
git commit -m
```

COPIARE I COMANDI DI DA GITHUB PER AGGIUNGERE L'ORIGINE REMOTA E PUSHARE SU MAIN
```bash
git remote add origin https://github.com/francescomascellino/laravel-one-to-many.git
git branch -M main
git push -u origin main
```

INSTALLARE LE DIPENDENZE
```bash
composer install
```

RINOMINARE IL FILE COPIA DI .env ED EFFETTUARE LE MODIFICHE

(DATI DEL DATABASE, NOME APP, DISK SU public...)

GENERARE LA CHIAVE DELL'APP
```bash
php artisan key:generate
```

COLLEGARE LO STORAGE
```bash
php artisan storage:link
```

INSTALLARE I PACCHETTI
```bash
npm i
```

ESEGUIRE LA MIGRAZIONE
```bash
php artisan migrate
```

SE NECESSARIO CREARE LA CARTELLA DI SALVATAGGIO DEI FILES IN storage/app/public/[image disk folder]


## INSTALLARE BREEZE AUTHENTICATION STARTER KIT

```bash
composer require laravel/breeze --dev
```

```bash
php artisan breeze:install
```

INSTALLARE BOOTSTRAP + VITE PRESET WITH AUTHENTICATION

```bash
composer require pacificdev/laravel_9_preset
```

```bash
php artisan preset:ui bootstrap --auth
```

## TABLE RELATIONS

CREATE THE NEW MODEL AND ITS MIGRATION

```bash
php artisan make:model Type

```
```bash
php artisan make:migration create_types_table
```

EDIT THE UP METHOD ON THE MIGRATION
```php
public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }
```

CREATE A SEEDER FOR THE NEW MODEL

```bash
php artisan make:seeder TypeSeeder
```
EDIT THE SEEDER

```php
$types = [
    'Fullstack', 'Frontend', 'Backend', 'API');
]

foreach ($types as $type) {
    $new_type = new Type;
    $new_type->name = $type;
    $new_type->slug = Str::slug($new_type->name, '-');
    $new_type->save();
}
```

```bash
php artisan db:seed --class=TypeSeeder
```

CREARE UNA MIGRATION PER AGGIUNGERE LA COLONNA CON LA FOREIGN KEY ALLA TABELLA E AL MODELLO PROJECTS

```bash
php artisan make:migration add_Type_id_foreign_key_to_projects_table
```

migrationin posts
UP

```php
$table->unsignedBiginteger('type_id')->nullable->after('id');
$table->foreign('type_id') // PROJECTS ha una FK legata al TYPE
->reference('id') // CAMPO
->on('types'); // NOME TABELLA
```

DOWN
```php
$table->dropForeign('projects_type_id_foreign'); // PROJECT ha una FK legata al TYPE
$table->dropColumn('type_id');
```

1 TYPE -> MANY PROJECTS
MODEL Type
```php
public function projects(): {
    return $this->hasMany(Project::class); // THIS TYPE HAS MANY PROJECTS
}
```

OGNI PROJECT -> 1 TYPE
MODEL Projects 
```php
public function category(): {
    return $this->belongsTo(Type::class); // THIS PROJECT BELONGS TO A TYPE
}
```

ProjectController create()
```php
$types = Type::all()
return view ('admin.projects.create', compact('types')
```

create.blade.php
```php
form select
<option selected disabled>Select one</option>
<option  value="">None</option>

@forelse ($types as $type)
<option value "{{$type->id}}" {{$type->id == old($type->id) ? selected : ''}} 
class="form-select 
@error('type_id') is-invalid 
@enderror">{{$type->name}}</option>

@empty

@endforeslse
```

PostsController edit()
```php
$types = Type::all()
return view ('admin.projects.edit', compact('types')
```

edit.blade.php
```php
form select
<option selected disabled>Select one</option>
<option  value="">None</option>

@forelse ($types as $type)
<option value "{{$type->id}}" {{$type->id == old($type->id, $type_id) ? selected : ''}} 
class="form-select 
@error('type_id') is-invalid 
@enderror">{{$type->name}}</option>

@empty

@endforeslse
```

Add to model Post
```php
$fillable = [... 'type_id'];
```

StorePostRequest
```php
'type_id' => ['nullable', 'exists:types.id'],
```

UpdatePostREquest
```php
'type_id' => ['nullable', 'exists:types.id'],
```

show.blade
```php
{{$project-type?->name}}
{{$project-type->name ? $project-type->name : 'Uncategorized'}}
```

## ASSOCIARE POST A USER
User -> Many Projects

Project -> one User. Project ha una FK legata all'User



PRIMA CREARE RELATION

Model post aggiungere la FK

```php
$fillable = [... 'category_id', 'user_id'];
```

PostController
MEDOTO store()
```php
$val_data['user_id'] = Auth::id()->orderbyDesc('id');
```

nel destroy() per evitare che altri elimino post non loro
```php
if($post->user_id === Auth::id()) {
    rules here
}
abort(403, 'NON PUOI');
```

index()
```php
$posts = Post::where('user_id', Auth::id())->orderByDesc('id')->paginate(12);
```

IMPEDIRE REGISTRAZONE E ROTTE AI NON LOGGATI

resources/routes/auth.php
```php
// 👇 COMMENTANDO QUESTE DUE ROTTE NON SARA' POSSIBILE REGISTRARSI ULTERIORMENTE
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
```
1 -> 1

model user
```php
public function userDetail () {
    return hasOne(User_Detail::class)
}
```

model User_detail
```php
public function user () {
    return $this->belongsTo(User::class)
}
```

1 -> *

model user
```php
pubic function posts(){
    return $this_>hasMany(Posts::class)
}
```

model post
```php
pubic function user(){
    return $this_>belongsTo(User::class)
}
```