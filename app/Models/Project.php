<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'thumb', 'description', 'tech', 'github', 'link'];

    // CHECK IF ALREADY EXISTS WHEN ADDING ENTRIES
    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
}
