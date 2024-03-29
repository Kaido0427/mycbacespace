<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avatar extends Model
{
    use HasFactory;

    protected $table = "avatars";

    protected $fillable = [
        'image', 'user_id'
    ];

    public function user()
    {
       return $this->hasOne(User::class);
    }
}
