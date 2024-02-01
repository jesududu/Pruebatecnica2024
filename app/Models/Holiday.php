<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'day',
        'month',
        'year',
        'is_recurrent',
        'start_date',
        'end_date',
        'user_id', // Asegúrate de incluir el user_id en la lista de atributos asignables
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
