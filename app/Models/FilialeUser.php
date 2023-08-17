<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilialeUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'filiale_user';
}
