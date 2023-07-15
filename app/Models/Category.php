<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    // use HasFactory;

    // protected $guard = [];
    protected $fillable = ['id', 'name', 'slug']; 

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
