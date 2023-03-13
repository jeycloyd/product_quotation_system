<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    //relationship to customer
    public function customers(){
        return $this->belongsTo(Customer::class);
    }
    //relationship to product
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
