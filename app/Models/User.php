<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\service;
use App\Models\tache;
use App\Models\procedure; 


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
        'engagement',
        'engagsup',
        'date',
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
    // Dans le modèle User
    public function taches()
    {
        return $this->belongsToMany(Tache::class, 'procedures', 'user_id', 'tache_id')
            ->withPivot(['id', 'doc_client', 'doc_traité', 'status']);
    }



    public function procedures()
    {
        return $this->hasMany(Procedure::class, 'user_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'user_services', 'user_id', 'service_id');
    }

    public function notifications()
    {
        return $this->hasMany(notification::class);
    }
}
