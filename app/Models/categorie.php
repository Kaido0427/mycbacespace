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

    public function procedures()
    {
        return $this->hasMany(Procedure::class, 'categorie_id');
    }

    public function taches()
    {
        return $this->hasMany(tache::class, 'categorie_id');
    }
}
