<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recapito extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'recapitos';

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }
}
