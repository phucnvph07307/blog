<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use QuanVT\Firebase\SyncWithFirebase;

class Notification extends Model
{
    use Notifiable, SyncWithFirebase;

    protected $table = 'notification';
    protected $fillable = ['title', 'content', 'route', 'user_id', 'auth_id', 'type'];
}
