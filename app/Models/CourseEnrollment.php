<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    protected $fillable = [
        'course_id', 'student_id', 'status', 'enrollment_date', 
        'completion_date', 'grade', 'grade_letter'
    ];

    protected $dates = [
        'enrollment_date', 'completion_date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(StudentRecord::class, 'student_id');
    }

    public function scopeEnrolled($query)
    {
        return $query->where('status', 'enrolled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeDropped($query)
    {
        return $query->where('status', 'dropped');
    }
}
