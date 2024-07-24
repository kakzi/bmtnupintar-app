<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPembiayaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'akad',
        'slug',
    ];

    //buat assesor 
    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['akad'] = Str::camel('Akad '.$value);
    }
}
