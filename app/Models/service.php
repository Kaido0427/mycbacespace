<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    protected $table = "services";

    protected $fillable = [
        'nom_service'
    ];

    public function clients()
    {
        return $this->belongsToMany(User::class, 'client_services', 'service_id', 'client_id');
    }

    public function taches()
    {
        return $this->hasMany(tache::class);
    }
}
