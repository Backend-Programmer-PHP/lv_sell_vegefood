<?php

namespace App\Modules\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Model extends Model
{

    protected $table = "products";
    protected $guarded = [];

    public function relatedProduct() {
        return $this->hasMany('App\Modules\Site\Models\Product_Model', 'categories_id', 'categories_id')->where('status', 'active')->orderBy('id', 'DESC')->limit(4);
    }
}
