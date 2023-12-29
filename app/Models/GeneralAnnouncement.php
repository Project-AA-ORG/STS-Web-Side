<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralAnnouncement extends Model
{
    use HasFactory;
    protected $table = 'general_announcement';
    protected $primaryKey = 'general_announcement_id';

    public static function getAllAnnouncement(){
        return GeneralAnnouncement::all();
    }

    public static function getLast10Records(){
        $recordCount = GeneralAnnouncement::get()->count();
        return ($recordCount < 10) ? GeneralAnnouncement::get() : GeneralAnnouncement::latest()->take(10)->get();
    }

    public static function getAnnouncementInId($announcementId){
        return GeneralAnnouncement::where("general_announcement_id", $announcementId)->first();
    }
    
    public static function deleteAnnouncement($announcementId){
        return GeneralAnnouncement::where("general_announcement_id", $announcementId)->delete();
    }
}