<?php

namespace App\Modules\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon_Model extends Model
{

    protected $table = "coupons";
    protected $guarded = [];

    //Product discount:
    public function discount($total) {
        if ($this->type == "fixed") {
            return $this->value;
        } elseif ($this->type == "percent") {
            return ($this->value / 100) * $total;
        } else {
            return 0;
        }
    }
}
