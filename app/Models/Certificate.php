<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_user',
        'modul',
        'certificate',
    ];


    public function kurs(){
        return $this->belongsTo(Kurs::class, 'modul'); 
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user'); 
    }
}
