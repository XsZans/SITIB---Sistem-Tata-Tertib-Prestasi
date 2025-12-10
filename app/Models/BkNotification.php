<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkNotification extends Model
{
    protected $fillable = [
        'user_id',
        'bk_session_id',
        'title',
        'message',
        'type',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bkSession()
    {
        return $this->belongsTo(BkSession::class);
    }
}