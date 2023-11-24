<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';

    public static function getAllStudents(){
        return student::all();
    }

    public static function searchUserName($username){
        return student::where('username', $username)->exists();
    }

    public static function getLastElement(){
        return student::latest()->first();
    }
}