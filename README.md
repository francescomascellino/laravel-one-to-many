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

```bash
php artisan make:model Category

```
```bash
php artisan make:migration create_categories_table
```

migration:
```php
$table->string('name', 50);
$table->string('slug')->unique();
```
php artisan make:seeder CategorySeeder
```php
$categories = [
    'Programming', 'Fullstack', 'Frontend', 'Backend', 'API');
]

foreach ($categories as $category) {
    $new_category = new Category;
    $new_category->name = $category;
    $new_category->slug = Str::slug($new_category->name, '-');
    $new_category->save();
}
```

```bash
php artisan db:seed --class=CategorySeeder
```

```bash
php artisan make:migration add_category_id_foreign_key_to_posts_table
```

migrationin posts
UP

```php
$table->unsignedBiginteger('category_id')->nullable->after('id');
$table->foreign('category_id') // POST ha una FK legata alla CATEGORY
->reference('id') // CAMPO
->on('categories'); // NOME TABELLA
```

DOWN
```php
$table->dropForeign('posts_category_id_foreign'); // POST ha una FK legata alla CATEGORY
$table->dropColumn('category_id');
```

Category -> many POSTS
MODEL Post
```php
public function posts(): {
    return $this->hasMany(Post::class); // THIS CATEGORY HAS MANY POSTS
}
```

MANY POSTS -> 1 CATEGORY
MODEL POST 

```php
public function category(): {
    return $this->belongsTo(Category::class); // THIS POST BELONGS TO A CATEGORY
}
```

PostsController create()
```php
$categories = Category::all()
return view ('admin.posts.create', compact('categories')
```

create.blade.php
```php
form select
<option selected disabled>Select one</option>
<option  value="">None</option>

@forelse ($categories as $category)
<option value "{{$category->id}}" {{$category->id == old($category->id) ? selected : ''}} 
class="form-select 
@error('category_id') is-invalid 
@enderror">{{$category->name}}</option>

@empty

@endforeslse
```

PostsController edit()
```php
$categories = Category::all()
return view ('admin.posts.edit', compact('categories')
```

edit.blade.php
```php
form select
<option selected disabled>Select one</option>
<option  value="">None</option>

@forelse ($categories as $category)
<option value "{{$category->id}}" {{$category->id == old($category->id, $category_id) ? selected : ''}} 
class="form-select 
@error('category_id') is-invalid 
@enderror">{{$category->name}}</option>

@empty

@endforeslse
```

Add to model Post
```php
$fillable = [... 'category_id'];
```

StorePostRequest
```php
'category_id' => ['nullable', 'exists:categories.id'],
```

UpdatePostREquest
```php
'category_id' => ['nullable', 'exists:categories.id'],
```

show.blade
```php
{{$post-category?->name}}
{{$post-category->name ? $post-category->name : 'Uncategorized'}}
```

User -> Many Posts

Post -> one User. Post ha una FK legata all'User

ASSOCIARE POST A USER

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