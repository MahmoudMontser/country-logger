<?php

namespace App\Models;

use App\Jobs\NotifyCountryUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Log extends Model
{
    use HasFactory;
    protected $fillable =['type','old_data','new_data'] ;
    protected $casts=['old_data'=>'json','new_data'=>'json',];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            NotifyCountryUpdates::dispatch($model)->delay(5);
        });

    }
    public function loggable()
    {
        return $this->morphTo();
    }
    public function country()
    {
        return $this->loggable()->first();
    }
}
