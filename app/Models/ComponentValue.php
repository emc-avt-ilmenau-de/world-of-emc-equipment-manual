<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentValue extends Model
{
    public function component()
    {
        return $this->belongsTo(Component::class);
    }
}
