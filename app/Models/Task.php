<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'project_id',
        'user_id',
        'description',
        'tags',
        'date_start',
        'date_end',
    ];
    
    public function getDateStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d\TH:i') : null;
    }

    public function getDateEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d\TH:i') : null;
    }
}
