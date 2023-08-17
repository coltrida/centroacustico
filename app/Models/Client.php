<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id', 'id');
    }
}
