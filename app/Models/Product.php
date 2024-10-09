<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'Product';
    protected $casts = [
        'ProductMiniDescription' => 'array',
        'ProductDescription' => 'array', // Tell Laravel to treat this as an array
        'ProductMultimediaPath' => 'array',
    ];
    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
