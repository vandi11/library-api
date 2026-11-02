<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konyv extends Model
{
    protected $table = 'konyvek';
    protected $fillable = ['cim', 'szerzo', 'isbn', 'kiadas_eve', 'olvaso_id'];

    public function olvaso(): BelongsTo
    {
        return $this->belongsTo(Olvaso::class);
    }
}
