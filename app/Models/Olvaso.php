<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Olvaso extends Model
{
    protected $table = 'olvasok';
    protected $fillable = ['nev', 'email'];

    public function konyvek(): HasMany
    {
        return $this->hasMany(Konyv::class);
    }
}
