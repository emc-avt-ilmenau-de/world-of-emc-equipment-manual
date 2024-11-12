<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentValue extends Model
{
    protected $primaryKey = 'ComponentValueID'; 
    protected $table = 'ComponentValue'; // Ensure this matches your database table name

    public function component()
    {
        return $this->belongsTo(Component::class, 'ComponentID');
    }
}
