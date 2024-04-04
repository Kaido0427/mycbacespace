<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenoms',
        'raison',
        'adresse',
        'bp',
        'telephone',
        'email',
        'declaration',
        'service',
        'engagement',
        'engagsup',
        'date',
        'origine',
        'dateCreate',
        'numAssocies',
        'regime',
        'password',
        'user_type'
    ];


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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function avatar()
    {
        return $this->hasOne(avatar::class);
    }

    public function payements()
    {
        return $this->hasMany(payment::class);
    }

    public function hasPaid()
    {
        //cette fonction veriifie si l'utilisateur a fait une transaction
        $payment = payment::where('user_id', auth()->user()->id)->first();

        if ($payment) {
            return true;
        }

        return false;
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
}
