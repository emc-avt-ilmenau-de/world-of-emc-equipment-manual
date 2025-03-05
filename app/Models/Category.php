<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'Category'; // ✅ Ensure the correct table name
    protected $primaryKey = 'CategoryID'; // ✅ Ensure the correct primary key

    public $timestamps = false; // ✅ Disable timestamps if your table does not have created_at and updated_at

    protected $fillable = ['CategoryName']; // ✅ Allows mass assignment

    /**
     * Relationship: A category has many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'CategoryID', 'CategoryID'); // ✅ Ensure correct foreign key mapping
    }
}
