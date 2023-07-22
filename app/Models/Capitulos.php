<?php

namespace App\Models;

use App\Http\Controllers\Localizacoes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Capitulos extends Model
{
    use HasFactory;

    public function capitulos(): HasMany{
        return $this->hasMany(Localizacoes::class);
    }
}
