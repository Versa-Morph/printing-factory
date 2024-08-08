<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaProduksi extends Model
{
    use HasFactory;

    public function desain()
    {
        return $this->belongsTo(DesainProduct::class, 'id_desain');
    }
}
