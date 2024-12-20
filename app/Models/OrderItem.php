<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'OrderItem';
    protected $fillable = [
        'OrderID', 'ProductID', 'ComponentID', 'ComponentValueName',
        'OrderItemQuantity', 'OrderItemPrice', 'OrderItemCurrency',
        'created_at', 'updated_at'
    ];

    use HasFactory;
    public function component()
    {
        return $this->belongsTo(Component::class, 'ComponentID', 'ComponentID');
    }
}
