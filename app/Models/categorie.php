<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'nom_categorie',
    ];

    public function clients()
    {
        return $this->hasMany(User::class, 'categorie_id', 'id');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 'categorie_id', 'id');
    }
}
