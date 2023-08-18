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

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
