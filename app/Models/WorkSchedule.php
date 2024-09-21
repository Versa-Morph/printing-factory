<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employe::class, 'employee_id');
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

}
