<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Menu extends Model implements Searchable
{
    // use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('menu.show', $this->id);
     
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->name,
           $url
        );
    }
}
