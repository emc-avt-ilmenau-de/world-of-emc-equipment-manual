<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    // Specify the table's primary key
    protected $primaryKey = 'ProductID';

    protected $table = 'Product';
    protected $casts = [
        'ProductMiniDescription' => 'array',
        'ProductDescription' => 'array', // Tell Laravel to treat this as an array
        'ProductMultimediaPath' => 'array',
    ];
    public function components()
    {
        return $this->belongsToMany(Component::class, 'ProductComponent', 'ProductID', 'ComponentID');
    }

    public function componentValues()
    {
        return $this->hasMany(ComponentValue::class, 'ComponentID');
    }
}
