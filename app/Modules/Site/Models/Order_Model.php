<?php

namespace App\Modules\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Model extends Model
{

    protected $table = "orders";
    protected $guarded = [];
    public function cart_info() {
        return $this->hasMany('App\Modules\Site\Models\Cart_Model', 'orders_id', 'id');
    }
    public static function getAllOrder($id) {
        return Order_Model::with('cart_info')->find($id);
    }
}
