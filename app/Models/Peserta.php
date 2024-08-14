<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peserta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function event(): BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function pegawai(): BelongsTo{
        return $this->belongsTo(Pegawai::class);
    }

    public function absensi(): HasMany{
        return $this->hasMany(Absensi::class);
    }

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
