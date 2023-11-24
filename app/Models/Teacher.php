<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';

    public static function getAllTeachers(){
        return teacher::all();
    }

    public static function searchUserName($username){
        return teacher::where('username', $username)->exists();
    }

    public static function getLastElement(){
        return teacher::latest()->first();
    }
}