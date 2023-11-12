<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryRequest extends Model
{
    use HasFactory;
    protected $fillable =['callback_url','ip','request'] ;
    protected $casts=['request'=>'json'];
}
