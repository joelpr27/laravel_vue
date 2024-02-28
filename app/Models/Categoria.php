<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre',
    ];

    public function recompensas(){
        return $this->belongsToMany(Recompensa::class, 'categorias_recompensas');
    }
}
