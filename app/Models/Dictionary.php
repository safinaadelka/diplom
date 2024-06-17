<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $table = 'dictionary'; 
    protected $fillable = [
        'id_user',
        'id_word',
        'status',
    ];

    public function word(){
        return $this->belongsTo(Word::class, 'id_word'); 
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user'); 
    }
}
