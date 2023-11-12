<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable =['name_ar','name_en','description_ar','description_en'];


    public function logs()
    {
        return $this->morphMany(Log::class,'loggable');
    }
}
