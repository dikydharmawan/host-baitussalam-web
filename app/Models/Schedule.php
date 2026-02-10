<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'start',
        'end',
        'date',
        'end_date',
        'location',
        'pemateri',
        'description',
        'created_by',
        'updated_by',
        'image'
    ];

    protected $casts = [
        'date' => 'date',
        'end_date' => 'date',
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function getStartTimeAttribute()
    {
        return $this->start
            ? Carbon::parse($this->start)->format('H:i')
            : null;
    }

    public function getEndTimeAttribute()
    {
        return $this->end
            ? Carbon::parse($this->end)->format('H:i')
            : null;
    }

    protected $appends = ['status', 'date_label'];

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        $startDate = Carbon::parse($this->date)->startOfDay();
        $endDate = $this->end_date
            ? Carbon::parse($this->end_date)->endOfDay()
            : Carbon::parse($this->date)->endOfDay();

        if ($now->between($startDate, $endDate)) {
            return 'Hari Ini';
        }

        if ($now->lt($startDate)) {
            return 'Akan Datang';
        }

        return 'Selesai';
    }
    public function getDateLabelAttribute()
    {
        $start = Carbon::parse($this->date);
        $end   = $this->end_date
            ? Carbon::parse($this->end_date)
            : $start;

        // 1 hari
        if ($start->equalTo($end)) {
            return $start->translatedFormat('d F Y');
        }

        // multi-day
        return $start->translatedFormat('d F Y')
            . ' - ' .
            $end->translatedFormat('d F Y');
    }
    public function items()
    {
        return $this->hasMany(ScheduleItem::class)->orderBy('time');
    }

    
}
