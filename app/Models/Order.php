<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'delivery_type',
        'delivery_address',
        'special_request',
        'accompanying_drink',
        'total_price',
        'confirmed_at',
        'prep_at',
        'delivery_at',
        'finished_at',
        'delivery_driver'
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'prep_at' => 'datetime',
        'delivery_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
