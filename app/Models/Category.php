<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    // use HasFactory;

    protected $guard = [];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
