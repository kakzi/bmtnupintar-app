<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeriodeAngsuran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'periode',
        'slug',
        'percentage'
    ];

    //buat assesor 
    public function setPeriodeAttribute($value){
        $this->attributes['periode'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


}
