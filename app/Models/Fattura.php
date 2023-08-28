<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fattura extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'fatturas';

    public function prova()
    {
        return $this->belongsTo(Prova::class);
    }
}
