<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getDataNascitaFormattataAttribute()
    {
        return Carbon::make($this->dataNascita)->format('d-m-Y');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id', 'id');
    }

    public function canale()
    {
        return $this->belongsTo(Canale::class, 'canale_id', 'id');
    }

    public function recapito()
    {
        return $this->belongsTo(Recapito::class, 'recapito_id', 'id');
    }

    public function prove()
    {
        return $this->hasMany(Prova::class);
    }
}
