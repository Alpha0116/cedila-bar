<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guests_count',
        'reservation_date',
        'reservation_time',
        'notes',
        'status'
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
