<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'prodottos';

    public function stato()
    {
        return $this->belongsTo(Statoapa::class);
    }

    public function listino()
    {
        return $this->belongsTo(Listino::class);
    }

    public function prova()
    {
        return $this->belongsTo(Prova::class, 'prova_id', 'id');
    }
}
