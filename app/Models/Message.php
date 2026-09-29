<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
    ];

    /**
     * Relationship: Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relationship: Get the receiver of the message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    
    public static function UnReadMessageCount($receiver_id, $senderId)
    {
        return Message::where('receiver_id', $receiver_id)
                        ->where('sender_id', $senderId)
                        ->where('is_read', 0)
                        ->count();
    }
 
 
 

}
