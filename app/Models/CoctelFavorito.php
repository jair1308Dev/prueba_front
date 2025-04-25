<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoctelFavorito extends Model
{
    use HasFactory;
    protected $table = 'cocteles_favoritos';
    protected $fillable = [
        'nombre',
        'instrucciones',
        'ingredientes',
        'idDrink',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'ingredientes' => 'array',
    ];

    public $timestamps = false; 
}
