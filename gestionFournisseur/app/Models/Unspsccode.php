<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unspsccode extends Model
{
    use HasFactory;

    protected $table = 'unspsccodes';
    protected $fillable = ['idUser','idUnspsc','details'];

    public function unspsc() : HasMany{
        return $this->hasMany('App\Unspsc');
    }


}

