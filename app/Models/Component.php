<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'Component'; // Correct table name
    protected $primaryKey = 'ComponentID'; // Specify the primary key
    public $incrementing = true; // Primary key is an auto-incrementing integer
    protected $keyType = 'int'; // Specify the key type
    public function product()
    {
        return $this->belongsToMany(Product::class, 'ProductComponent', 'ComponentID', 'ProductID');
    }

    public function values()
    {
        return $this->hasMany(ComponentValue::class, 'ComponentID');
    }

}
