<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unspsc extends Model
{
    use HasFactory;


    protected $table = 'unspsc';


    public function fournisseurs()
{
    return $this->belongsToMany(Fournisseur::class, 'unspsccodes', 'idUnspsc', 'fournisseur_id');
}
}



