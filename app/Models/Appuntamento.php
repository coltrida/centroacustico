<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appuntamento extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'appuntamentos';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
