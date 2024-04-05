<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userServices extends Model
{
    use HasFactory;

    protected $table = "user_services";

    protected $fillable = [
        'user_id', 'service_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(service::class, 'service_id');
    }
}
