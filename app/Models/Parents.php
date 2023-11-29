<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parent';

    public static function getAllParents(){
        return Parents::all();
    }

    public static function searchUserName($username){
        return Parents::where('username', $username)->exists();
    }

    public static function getLastElement(){
        return Parents::latest()->first();
    }
}