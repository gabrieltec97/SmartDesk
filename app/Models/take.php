<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class take extends Model
{
    protected $fillable = ['take_id', 'item', 'quantity', 'condominium'];
}
