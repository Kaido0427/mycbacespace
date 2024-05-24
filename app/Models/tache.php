<?php

namespace App\Models;

use App\Models\procedure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tache extends Model
{
    use HasFactory;

    protected $table = "taches";

    protected $fillable = [
        'nom_tache', 'description', 'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(categorie::class);
    }
    public function procedures()
    {
        return $this->hasMany(procedure::class, 'tache_id');
    }


   
}
