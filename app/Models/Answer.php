<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
