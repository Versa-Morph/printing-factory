<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalProduksi extends Model
{
    use HasFactory;

    public function rencana()
    {
        return $this->belongsTo(RencanaProduksi::class, 'id_rencana');
    }
}
