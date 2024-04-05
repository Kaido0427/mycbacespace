<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class procedure extends Model
{
    use HasFactory;

    protected $table = "procedures";

    protected $fillable = ['doc_client', 'doc_traité', 'user_id', 'categorie_id', 'tache_id', 'status'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }


    public function tache()
    {
        return $this->belongsTo(Tache::class, 'tache_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
