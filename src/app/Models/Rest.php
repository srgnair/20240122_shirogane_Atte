<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Rest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'attendance_id',
        'rest_start_time',
        'rest_end_time',
        'rest_duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id');
    }

    // public function getTotalRestTime()
    // {
    //     $start = new DateTime($this->rest_start_time);
    //     $end = new DateTime($this->rest_end_time);
    //     $interval = $start->diff($end);

    //     return $interval;
    // }
}
