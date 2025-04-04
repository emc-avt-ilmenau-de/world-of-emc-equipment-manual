<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'ProductID';
    protected $table = 'Product';
    protected $casts = [
        'ProductName' => 'array',
        'ProductMiniDescription' => 'array',
        'ProductDescription' => 'array',
        'ProductMultimediaPath' => 'array',
    ];

    public function components()
    {
        return $this->belongsToMany(Component::class, 'ProductComponent', 'ProductID', 'ComponentID');
    }

    // Access ComponentValues indirectly via components
    public function componentValues()
    {
        return $this->components->flatMap(function ($component) {
            return $component->componentValues;
        });
    }

    // ✅ Relationship: A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }
}
