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
    
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id')->with('classrooms', 'course');
    }

    public static function getAnnouncementInId($classroomAnnouncementId){
        return ClassroomAnnouncement::where("classroom_announcement_id", $classroomAnnouncementId)->first();
    }

    public static function getAnnouncementInClassroom($classroomId){
        return ClassroomAnnouncement::where("classroom_id", $classroomId)->with('teacher')->get();
    }

    public static function getLastAnnouncementByClassroomId($classroomId){
        return ClassroomAnnouncement::where('classroom_id', $classroomId)->orderByDesc('created_at')->first();
    }

    public static function deleteAnnouncementInId($classroomAnnouncementId){
        ClassroomAnnouncement::where("classroom_announcement_id", $classroomAnnouncementId)->delete();
    }
}