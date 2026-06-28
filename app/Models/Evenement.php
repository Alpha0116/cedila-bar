<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $table = 'evenements';

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'image_path',
        'is_published'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_published' => 'boolean'
    ];
}
