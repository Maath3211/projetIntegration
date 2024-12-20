<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FournisseurCoord;
use App\Models\Contact;
use App\Models\Finance;
use App\Models\Unspsccode;
use App\Models\File;
use App\Models\RBQLicence;
use App\Models\Categorie;



class Fournisseur extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "fournisseurs";
    protected $fillable = [
        'email',
        'neq',
        'entreprise',
        'password',
        'codeReset',
        'demandeReset',
        'raisonRefus',
        'id',
    ];

    public function coordonnees()
    {
        return $this->hasOne(FournisseurCoord::class, 'fournisseur_id');
    }

    public function contacts(){
        return $this->hasMany(Contact::class, 'fournisseur_id');
    }

    public function unspsc()
    {
        return $this->belongsToMany(UNSPSC::class, 'unspsccodes', 'fournisseur_id', 'idUnspsc');
    }

    public function unspscCodes()
    {
        return $this->hasMany(Unspsccode::class, 'fournisseur_id');
    }
    

    public function files()
    {
        return $this->hasMany(File::class, 'fournisseur_id');
    }


    public function finance(){
        return $this->hasOne(Finance::class, 'fournisseur_id');
    }

    public function rbq(){
        return $this->hasOne(RBQLicence::class, 'fournisseur_id');
    }

    public function categorie(){
        return $this->hasManyThrough(Categorie::class,RBQLicence::class,'fournisseur_id','id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        
    ];

    /*public function contact(){
        return $this->hasMany(Contact::class)->withPivot('fournisseur_id','contact_id');
    } */
}
