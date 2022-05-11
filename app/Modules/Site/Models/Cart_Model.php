<?php

namespace App\Modules\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Model extends Model
{

    protected $table = "carts";
    protected $guarded = [];
    //Define a relationship with table products
    public function product() {
        return $this->belongsTo('App\Modules\Site\Models\Product_Model', 'products_id');
    }
}
