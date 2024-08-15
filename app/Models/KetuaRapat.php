<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KetuaRapat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function event(): BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function pegawai(): BelongsTo{
        return $this->belongsTo(Pegawai::class);
    }
}

