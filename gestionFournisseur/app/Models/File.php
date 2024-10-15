<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $fillable = [
        'nomFichier',
        'lienFichier',
        'tailleFichier_KO',
        'emailFinance',
        'fournisseur_id'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
