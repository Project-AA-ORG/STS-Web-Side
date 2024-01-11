<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'event_id';

    public static function getAllEvent(){
        return Event::all();
    }

    public static function getEventInId($eventId){
        return Event::where("event_id", $eventId)->first();
    }
    
    public static function deleteEvent($eventId){
        return Event::where("event_id", $eventId)->delete();
    }
}