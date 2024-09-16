<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }
}