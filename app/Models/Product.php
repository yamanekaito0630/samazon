<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Product extends Model
{
    use HasFactory;
    use Favoriteable, Sortable;

    public $sortable=[
      'price',
      'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
}
