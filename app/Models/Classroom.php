<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model
{
    public $fillable = [
        'name',
        'slug'
    ];

    public function subjects(){
        return $this->belongsToMany(Subject::class, 'classroom_has_subjects', 'classroom_id', 'subject_id');
    }

    public function students():BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_has_classes', 'classrooms_id', 'students_id');
    }
}
