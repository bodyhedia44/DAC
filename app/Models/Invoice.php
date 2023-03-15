<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Psy\Util\Str;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];

    public $incrementing=false;
    protected $primaryKey='uuid';
    protected $keyType='string';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            if (empty($model->uuid)){
                $model->uuid=\Illuminate\Support\Str::uuid();
            }
        });

    }
}
