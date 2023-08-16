<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiale extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'filiales';

    public function clienti()
    {
        return $this->hasMany(Client::class, 'filiale_id', 'id');
    }
}
