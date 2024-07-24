<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeyIndicatorTeller extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'indicator_one',
        'kpi_one',
        'target_notif',
        'tercapai_notif',
        'kurang_notif',
        'target_aplikasi',
        'tercapai_aplikasi',
        'kurang_aplikasi',
        'nilai_one',
        'total_one',
        'indicator_two',
        'kpi_two',
        'notes_two',
        'nilai_two',
        'total_two',
        'indicator_three',
        'kpi_three',
        'notes_three',
        'nilai_three',
        'total_three',
        'indicator_four',
        'kpi_four',
        'notes_four',
        'nilai_four',
        'total_four',
        'indicator_five',
        'kpi_five',
        'notes_five',
        'nilai_five',
        'total_five',
        'indicator_six',
        'kpi_six',
        'notes_six',
        'nilai_six',
        'total_six',
        'description',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}
