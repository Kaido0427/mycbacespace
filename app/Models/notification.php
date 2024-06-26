<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'message',
        'read',
        'status',
        'last_updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
