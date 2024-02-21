<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    use HasFactory;
    protected $fillable = array(
        "answer",
        "question_id",
        "user_id"
       );
}
