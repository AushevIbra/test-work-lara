<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = [];



    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class)->withDefault('');
    }
}
