<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{

    protected $fillable = [
        'schedule_id',
        'time',
        'title',
        'description',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
