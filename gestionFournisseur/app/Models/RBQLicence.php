<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class RBQLicence extends Model
{
    use HasFactory;
    protected $fillable = ['neq','licenceRBQ','statut','typeLicence','idCategorie','fournisseur_id'];

    public function unspsc() : HasMany{
        return $this->hasMany('App\Categorie');
    }

    protected $table = 'rbqLicences';
}
