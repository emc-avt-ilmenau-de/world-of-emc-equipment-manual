<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $table = 'Product';   // actual table name
    protected $PrimaryKey = 'ProductId';

    protected $fillable = ['ProductName', 'ProductPrice', 'ProductCurrency'];

    // Relationship: Product has many components
    public function Component()
    {
        return $this->hasMany(Component::class);
    }
}
