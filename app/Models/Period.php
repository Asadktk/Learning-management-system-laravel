<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Period extends Model
{
    use HasFactory;

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected $appends = [
        'start_time_formatted',
        'end_time_formatted',
    ];

    public function getStartTimeFormattedAttribute()
    {
        return $this->start_time->format('j F Y, g:i:s A');
    }

    public function getEndTimeFormattedAttribute()
    {
        return $this->end_time->format('j F Y, g:i:s A');
    }
    
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
   
}
