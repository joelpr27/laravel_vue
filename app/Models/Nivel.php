<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;


    protected $table = 'niveles';

    protected $fillable = [
        'numero',
        'experiencia',
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'nivel_id');
    }
}
