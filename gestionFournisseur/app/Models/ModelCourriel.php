<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCourriel extends Model
{
    use HasFactory;
    protected $table = 'model_courriel';

    protected $fillable = [
        'nom',
        'sujet',
        'contenu',
    ];
}
