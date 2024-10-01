<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FournisseurCoord;
use App\Models\Contact;



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
    ];

    public function coordonnees()
    {
        return $this->hasMany(FournisseurCoord::class, 'fournisseur_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'fournisseur_id');
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
