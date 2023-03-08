<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    //relationship to customer
    public function customers(){
        return $this->belongsTo(Customer::class);
    }
}
