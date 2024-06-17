<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'study'; 
    protected $fillable = [
        'id_user',
        'id_lesson',
        'modul',
        'status',
    ];

    public function lesson(){
        return $this->belongsTo(Lesson::class, 'id_lesson'); 
    }
    public function kurs(){
        return $this->belongsTo(Kurs::class, 'modul'); 
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user'); 
    }
}
