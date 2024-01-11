<?php

namespace App\Http\Controllers;

use App\Models\ClassroomAnnouncement;
use App\Models\Event;
use App\Models\GeneralAnnouncement;
use App\Models\Homework;
use App\Models\HomeworkResult;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request){

        $teacherInfo = Teacher::getTeachersWithClassroomsAndCourse(); // Dersi ve sınıfları ile birlikte öğretmeni return eder
        if (isset($teacherInfo)){
            if (is_iterable($teacherInfo)) {
                foreach ($teacherInfo as $teacher){
                    if ($teacher->username == $request->username){
                        if ($teacher->password == $request->password){
                            return response()->json(['user' => $teacher], 201);
                        }
                    }
                }
            }
        }
        $studentInfo = Student::getClassroomWithStudents(); // Sınıfı ile birlikte öğrencileri return eder
        if (isset($studentInfo)){
            if (is_iterable($studentInfo)) {
                foreach ($studentInfo as $student){
                    if ($student->username == $request->username){
                        if ($student->password == $request->password){
                            return response()->json(['user' => $student], 202);
                        }
                    }
                }
            }
        }
        $parentInfo = Parents::getParentsWithStudents(); //Öğrencileri ile birlikte velileri return eder
        if (isset($parentInfo)){
            if (is_iterable($parentInfo)) {
                foreach ($parentInfo as $parent){
                    if ($parent->username == $request->username){
                        if ($parent->password == $request->password){
                            if (is_iterable($parent->students)){
                                foreach ($parent->students as $student){
                                    $imagePath = $student->student_image;
                                    // Eğer dosya varsa, base64 formatına çevir ve JSON yanıta ekle
                                    if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                                        $student->student_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                                    }
                                }
                            }
                            return response()->json(['user' => $parent], 203);
                        }
                    }
                }
            }
        }
        return response()->json(['$error' => "Kullanıcı adı veya şifre hatalı!"], 404);
    }
    
    public function changeTeacherPassword(Request $request){
        if ($request->isMethod('post')) {
            $teacher = Teacher::getTeacher($request->teacher_id);
            if (isset($teacher)){
                $teacher->password = $request->password;
                $teacher->save();
            }
            return response()->json(['$success' => "Şifre değiştirildi"], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    public function changeStudentPassword(Request $request){
        if ($request->isMethod('post')) {
            $student = Student::getStudentInId($request->student_id);
            if (isset($student)){
                $student->password = $request->password;
                $student->save();
            }
            return response()->json(['$success' => "Şifre değiştirildi"], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    public function changeParentPassword(Request $request){
        if ($request->isMethod('post')) {
            $parent = Parents::getParentInId($request->parent_id);
            if (isset($parent)){
                $parent->password = $request->password;
                $parent->save();
            }
            return response()->json(['$success' => "Şifre değiştirildi"], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    //bir velinin öğrencilerini json tipinde döndürür.
    public function studentsOfParent($parentId){
        $students = Parents::getStudentsByParentId($parentId);
        if (!isset($students)){
            return response()->json(['error' => 'Students not found'], 404);
        }
        return response()->json(['students' => $students], 200);
    }

    //homework ü db ye ekler ve 200 başarılı kodunu döndürür.
    public function saveHomeworkToDB(Request $request){
        if ($request->isMethod('post')) {
            $homework = new Homework();
            $homework->classroom_id = $request->classroom_id;
            $homework->teacher_id = $request->teacher_id;
            if (isset($request->title)){
                $homework->title = $request->title;
            }
            if (isset($request->content)){
                $homework->content = $request->content;
            }
            if (isset($request->course_name)){
                $homework->course_name = $request->course_name;
            }
            if (isset($request->hw_image)){
                $imageData = $request->hw_image;
                $image = base64_decode($imageData);
                $filename = Str::random(40) . '.jpg';
                Storage::disk('public')->put("images/{$filename}", $image);
                $homework->image =  "images/{$filename}";
            }
            if (isset($request->due_date)){
                $homework->due_date = $request->due_date;
            }
            $homework->save();
            return response()->json(['success' => 'Homework is saved'], 200);
        }else{
            return redirect()->route('home-page');
        }
    }

    //announcment ı db ye ekler ve 200 başarılı koudunu döndürür.(classroom_announcement)
    public function saveAnnouncementToDB(Request $request){
        if ($request->isMethod('post')) {
            $announcement = new ClassroomAnnouncement();
            if (isset($request->teacher_id)){
                $announcement->teacher_id = $request->teacher_id;
            } else{
                return response()->json(['error' => 'Announcement is not saved'], 400);
            }
            if (isset($request->classroom_id)){
                $announcement->classroom_id = $request->classroom_id;
            } else{
                return response()->json(['error' => 'Announcement is not saved'], 400);
            }
            if (isset($request->announcement_title)){
                $announcement->announcement_title = $request->announcement_title;
            }
            if (isset($request->announcement_content)){
                $announcement->announcement_content = $request->announcement_content;
            }
            $announcement->save();
            return response()->json(['success' => 'Announcement is saved'], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    //classroom_id alıp o sınıfta yapılan duyurular verilen ödevler ve ödevlerin sonuçlarını dönderir. Veli ödev ve duyuru kısımlarını görüntülemek istediğinde gönderiyorum.
    public function giveInformationAboutClassHomework($classroomId, $studentId){
        if (isset($studentId) && isset($classroomId)){
            $homeworkWithResults = Homework::getHomeworkWithResultsInId($studentId, $classroomId);
            if (isset($homeworkWithResults)){
                if (is_iterable($homeworkWithResults)){
                    foreach ($homeworkWithResults as $homework) {
                        $imagePath = $homework->image;
                        // Eğer dosya varsa, base64 formatına çevir ve JSON yanıta ekle
                        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                            $homework->image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                        } 
                    }
                } else{
                    $imagePath = $homeworkWithResults[0]->image;
                    $homeworkWithResults[0]->image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                }  
            }
        } else{
            return response()->json(['error' => 'Informations cannot be given'], 400);
        }
        return response()->json(['homeworks' => $homeworkWithResults], 200);
    }

    public function giveInformationAboutClassAnnouncement($classroomId){
        if (isset($classroomId)){
            $classroom_announcement = ClassroomAnnouncement::getAnnouncementInClassroom($classroomId);
        } else{
            return response()->json(['error' => 'Informations cannot be given'], 400);
        }
        return response()->json(['classroom_announcements' => $classroom_announcement], 200);
    }

    public function getImageForTeacher(Request $request){
        if ($request->isMethod('post')){
            $teacher = Teacher::getTeacher($request->teacherId);
            if (isset($request->image_teacher)){
                if ($teacher->teacher_image){
                    Storage::disk('public')->delete($teacher->teacher_image);
                }
                $imageData = $request->image_teacher;
                $image = base64_decode($imageData);
                $filename = Str::random(40) . '.jpg';
                Storage::disk('public')->put("images/{$filename}", $image);
                $teacher->teacher_image =  "images/{$filename}";
                $teacher->save();
                return response()->json(['success' => 'Save is successful'], 200);
            } else {
                if ($teacher->teacher_image){
                    Storage::disk('public')->delete($teacher->teacher_image);
                }
                $teacher->teacher_image = null;
                $teacher->save();
                return response()->json(['success' => 'Null save is successful'], 200);
            }
        } else {
            return redirect()->route('home-page');
        }
    }

    public function getImageForStudent(Request $request){
        if ($request->isMethod('post')){
            $student = Student::getStudentInId($request->studentId);
            if (isset($request->image_student)){
                if ($student->student_image){
                    Storage::disk('public')->delete($student->student_image);
                }
                $imageData = $request->image_student;
                $image = base64_decode($imageData);
                $filename = Str::random(40) . '.jpg';
                Storage::disk('public')->put("images/{$filename}", $image);
                $student->student_image =  "images/{$filename}";
                $student->save();
                return response()->json(['success' => 'Save is successful'], 200);
            } else {
                if ($student->student_image){
                    Storage::disk('public')->delete($student->student_image);
                }
                $student->student_image = null;
                $student->save();
                return response()->json(['success' => 'Null save is successful'], 200);
            }
        } else {
            return redirect()->route('home-page');
        }
    }

    public function classroomOfTeacher($teacherId){
        $classrooms = Teacher::getClassroomsByTeacherId($teacherId);
        if (!isset($classrooms)){
            return response()->json(['error' => 'Classrooms not found'], 404); 
        }
        return response()->json(['classrooms' => $classrooms], 200); 
    }

    public function giveInformationAboutClassHomeworksForTeacher($classroomId){
        if (isset($classroomId)){
            $homeworks = Homework::getHomeworksWithResultsInId($classroomId);
            if (is_iterable($homeworks)){
                foreach ($homeworks as $homework) {
                    $imagePath = $homework->image;
                    // Eğer dosya varsa, base64 formatına çevir ve JSON yanıta ekle
                    if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                        $homework->image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                    }
                }
            } else{
                $imagePath = $homeworks[0]->image;
                $homeworks[0]->image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
            } 
            $students = Student::getStudentInClassroomId($classroomId);
            if (is_iterable($students)){
                foreach($students as $student){
                    $imagePath = $student->student_image;
                    // Eğer dosya varsa, base64 formatına çevir ve JSON yanıta ekle
                    if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                        $student->student_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                    }
                }
            } else{
                $imagePath = $students[0]->student_image;
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    $students[0]->student_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                }
            }
            return response()->json(['homeworks' => $homeworks, 'students' => $students], 200);
        } else{
            return response()->json(['error' => 'Informations cannot be given'], 400);
        }
    }

    public function giveInformationAboutClassAnnouncementsForTeacher($classroomId){
        if (isset($classroomId)){
            $classroom_announcement = ClassroomAnnouncement::getAnnouncementInClassroom($classroomId);
            return response()->json(['classroom-announcements' => $classroom_announcement], 200);
        } else{
            return response()->json(['error' => 'Informations cannot be given'], 400);
        }
    }

    public function getHomeworkResultsInSomeId($homework_id, $student_id){
        if (isset($homework_id)){
            if (isset($student_id)){
                $result = HomeworkResult::getHomeworkResult($homework_id, $student_id);
                return response()->json(['result' => $result], 200);
            }
        }
        return response()->json(['error' => 'Informations cannot be given'], 400);
    }

    public function deleteHomeworkInId($homeworkId){
        if (isset($homeworkId)){
            $homework = Homework::getHomeworkInHomeworkId($homeworkId);
            if ($homework->image){
                Storage::disk('public')->delete($homework->image);
            }
            Homework::deleteHomeworkInId($homeworkId);
            return response()->json(['success' => 'Homework is deleted'], 200);
        }
        return response()->json(['error' => 'Homework cannot be deleted'], 400);
    }

    public function deleteClassroomAnnouncementInId($classroomAnnouncementId){
        if (isset($classroomAnnouncementId)){
            ClassroomAnnouncement::deleteAnnouncementInId($classroomAnnouncementId);
            return response()->json(['success' => 'Announcement is deleted'], 200);
        }
        return response()->json(['error' => 'Announcement cannot be deleted'], 400);
    }

    public function updateHomework(Request $request){
        if ($request->isMethod('post')) {
            $homework = Homework::getHomeworkInHomeworkId($request->homework_id);
            if (isset($request->classroom_id)){
                $homework->classroom_id = $request->classroom_id;
            } else{
                return response()->json(['error' => 'Homework is not saved'], 400);
            }
            if (isset($request->teacher_id)){
                 $homework->teacher_id = $request->teacher_id;
            } else{
                return response()->json(['error' => 'Homework is not saved'], 400);
            }
           
            if (isset($request->title)){
                $homework->title = $request->title;
            }
            if (isset($request->content)){
                $homework->content = $request->content;
            }
            if (isset($request->course_name)){
                $homework->course_name = $request->course_name;
            }
            if (isset($request->hw_image)){
                if ($homework->image){
                    Storage::disk('public')->delete($homework->image);
                }
                $imageData = $request->hw_image;
                $image = base64_decode($imageData);
                $filename = Str::random(40) . '.jpg';
                Storage::disk('public')->put("images/{$filename}", $image);
                $homework->image =  "images/{$filename}";
            }
            if (isset($request->due_date)){
                $homework->due_date = $request->due_date;
            }
            $homework->save();
            return response()->json(['success' => 'Homework is updated'], 200);
        }else{
            return redirect()->route('home-page');
        }
    }

    public function updateAnnouncement(Request $request){
        if ($request->isMethod('post')) {
            $announcement = ClassroomAnnouncement::getAnnouncementInId($request->classroom_announcement_id);
            if (isset($request->teacher_id)){
                $announcement->teacher_id = $request->teacher_id;
            } else{
                return response()->json(['error' => 'Announcement is not saved'], 400);
            }
            if (isset($request->classroom_id)){
                $announcement->classroom_id = $request->classroom_id;
            } else{
                return response()->json(['error' => 'Announcement is not saved'], 400);
            }
            if (isset($request->announcement_title)){
                $announcement->announcement_title = $request->announcement_title;
            }
            if (isset($request->announcement_content)){
                $announcement->announcement_content = $request->announcement_content;
            }
            $announcement->save();
            return response()->json(['success' => 'Announcement is updated'], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    public function saveResultToDB(Request $request){
        if ($request->isMethod('post')) {
            $result = new HomeworkResult();
            if (isset($request->homework_id)){
                $result->homework_id = $request->homework_id;
            } else{
                return response()->json(['error' => 'Result is not saved'], 400);
            }
            if (isset($request->student_id)){
                $result->student_id = $request->student_id;
            } else{
                return response()->json(['error' => 'Result is not saved'], 400);
            }
            if (isset($request->note_for_parent)){
                $result->note_for_parent = $request->note_for_parent;
            }
            if (isset($request->grade)){
                $result->grade = $request->grade;
            }
            $result->save();
            return response()->json(['success' => 'Result is saved'], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    public function updateResult(Request $request){
        if ($request->isMethod('post')) {
            $result = HomeworkResult::getHomeworkResultInId($request->homework_result_id);
            if (isset($request->homework_id)){
                $result->homework_id = $request->homework_id;
            } else{
                return response()->json(['error' => 'Result is not updated'], 400);
            }
            if (isset($request->student_id)){
                $result->student_id = $request->student_id;
            } else{
                return response()->json(['error' => 'Result is not updated'], 400);
            }
            if (isset($request->note_for_parent)){
                $result->note_for_parent = $request->note_for_parent;
            }
            if (isset($request->grade)){
                $result->grade = $request->grade;
            }
            $result->save();
            return response()->json(['success' => 'Result is updated'], 200);
        } else{
            return redirect()->route('home-page');
        }
    }

    public function sendEventsAndAnnouncements(){
        $events = Event::getLast10Records();
        foreach ($events as $event) {
            $imagePath = $event->event_image;
            // Eğer dosya varsa, base64 formatına çevir ve JSON yanıta ekle
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                $event->event_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
            }
        }
        $announcements = GeneralAnnouncement::getLast10Records();
        return response()->json(['events' => $events, 'announcements' => $announcements], 200);
    }

    public function getLastHomeworkAndAnnouncementId($studentId){
        if (isset($studentId)){
            $student = Student::getStudentInId($studentId);
            if (isset($student)){
                $classroomId = $student->classroom_id;
                $lastHomework = Homework::getLastHomeworkByClassroomId($classroomId);
                $lastAnnouncement = ClassroomAnnouncement::getLastAnnouncementByClassroomId($classroomId);
                if (!(isset($lastHomework))){
                    if (!(isset($lastAnnouncement))){
                        return response()->json(['state' => "There is no homework and announcement"], 201);
                    }
                    return response()->json(['state' => "There is no homework", 'announcement_id' => $lastAnnouncement->classroom_announcement_id], 202);
                }
                if (!(isset($lastAnnouncement))){
                    return response()->json(['state' => "There is no announcement", 'homework_id' => $lastHomework->homework_id], 203);
                }
                return response()->json(['homework_id' => $lastHomework->homework_id, 'announcement_id' => $lastAnnouncement->classroom_announcement_id], 200);
            }
            return response()->json(['state' => "There is no student in that id"], 204);
        }
        return response()->json(['error' => "This id is not valid or null"], 400);
    }
}

