<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public function quotationRemark()
    {
        return $this->hasMany(QuotationRemarks::class);
    }

    public function quotationTerm()
    {
        return $this->hasMany(QuotationTerms::class);
    }
}
