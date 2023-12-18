<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomAnnouncement extends Model
{
    use HasFactory;
    protected $table = 'classroom_announcement';
    protected $primaryKey = 'classroom_announcement_id';

    public static function getAllClassrooms(){
        return ClassroomAnnouncement::all();
    }

    public static function getAnnouncementInId($classroomAnnouncementId){
        return ClassroomAnnouncement::where("classroom_announcement_id", $classroomAnnouncementId)->first();
    }

    public static function getAnnouncementInClassroom($classroomId){
        return ClassroomAnnouncement::where("classroom_id", $classroomId)->get();
    }

    public static function deleteAnnouncementInId($classroomAnnouncementId){
        ClassroomAnnouncement::where("classroom_announcement_id	", $classroomAnnouncementId)->delete();
    }
}