<?php

namespace App\Models;

use App\Models\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    //relationship to quotation
    public function quotations(){
        return $this->hasMany(Quotation::class);
    }
}
