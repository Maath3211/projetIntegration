<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FournisseurCoord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "coordonnees";
    protected $fillable = [
        'noCivic',
        'rue',
        'bureau',
        'ville',
        'province',
        'codePostal',
        'codeRegion',
        'nomRegion',
        'site',
        'typeTel',
        'numero',
        'poste',
        'typeTel2',
        'numero2',
        'poste2',
        'fournisseur_id'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }


}

