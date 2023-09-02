<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'provas';

    public function getTotFormattatoAttribute()
    {
        return $this->tot ? '€ '.number_format( (float) $this->tot, '0', ',', '.') : null;
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function canale()
    {
        return $this->belongsTo(Canale::class, 'canale_id', 'id');
    }

    public function stato()
    {
        return $this->belongsTo(Statoapa::class, 'stato_id', 'id');
    }

    public function prodotti()
    {
        return $this->hasMany(Prodotto::class, 'prova_id', 'id');
    }

    public function fattura()
    {
        return $this->hasOne(Fattura::class, 'prova_id', 'id');
    }
}
