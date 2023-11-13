<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

INSTALLARE BREEZE AUTHENTICATION STARTER KIT

```
composer require laravel/breeze --dev
```

```
php artisan breeze:install
```

INSTALLARE BOOTSTRAP + VITE PRESET WITH AUTHENTICATION

```
composer require pacificdev/laravel_9_preset

php artisan preset:ui bootstrap --auth
```

PER FAR SI CHE SOLO L'UTENTE CON ID 1 POSSA EFFETTUARE MODIFICHE, NELLE FORM REQUESTS:

(CAMBIARE SU ***true*** SE SI DESIDERA CHE TUTTI POSSANO MODIFICARE)

```php
public function authorize(): bool
{
    // return true;
    return Auth::id() === 1; // SOLO USER ID 1 PUO' CREARE
}
```
```php
public function authorize(): bool
    {
        // return true;
        return Auth::id() === 1; // SOLO USER ID 1 PPUO' AGGIORNARE
    }
```

## EXAMPLE PAGINATION:

```
php artisan vendor:publish // selezionare Pagination
```

NEL CONTROLLER (app/http/Controllers/Admin/ProjectController IN THIS EXAMPLE):

```php
public function index()
{
    // PAGINATION
    $projects = Project::orderByDesc('id')->paginate(4);

    return view('admin.projects.index', compact('projects'));
    }
```

NEL MARKUP (ADMIN/PROJECTS/INDEX.BLADE IN THIS EXAMPLE):

```php
<div class="my-3">
    {{ $projects->links('pagination::bootstrap-5') }}
</div>
```

Bootstrap responsiveness order:

```
general (es d-none) - sm (es d-sm-none) - md (es d-md-block) lg (es d-lg-block)
```