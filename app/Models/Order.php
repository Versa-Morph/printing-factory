<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderRemark()
    {
        return $this->hasMany(OrderManagementRemarks::class , 'order_management_id' , 'id');
    }

    public function orderColor()
    {
        return $this->hasMany(OrderManagementColors::class , 'order_management_id' , 'id');
    }

    public function orderSize()
    {
        return $this->hasMany(OrderManagementSizes::class , 'order_management_id' , 'id');
    }

    public function orderDesign()
    {
        return $this->hasMany(OrderManagementDesign::class , 'order_management_id' , 'id');
    }
}
