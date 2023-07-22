<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Localizacoes extends Model
{
    use HasFactory;

    public function localizacoes(): HasMany{
        return $this->hasMany(Localizacoes::class);
    }

    protected $table = 'objetos';

    protected $fillable = [
        'nome',
        'descricao',
        'camada',
        'objeto_pai',
    ];
}
