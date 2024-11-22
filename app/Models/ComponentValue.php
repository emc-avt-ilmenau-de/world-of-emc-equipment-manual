<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComponentValue extends Model
{

    use HasFactory;

    protected $fillable = [
        'ComponentID',
        'ComponentValueName',
        'ComponentValuePrice',
        'ComponentValueCurrency',
    ];
    protected $primaryKey = 'ComponentValueID'; 
    protected $table = 'ComponentValue'; // Ensure this matches your database table name

    public function component()
    {
        return $this->belongsTo(Component::class, 'ComponentID');
    }

    
}
