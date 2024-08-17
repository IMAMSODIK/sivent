<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function peserta(): HasMany{
        return $this->hasMany(Peserta::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function unitKerja(): BelongsTo{
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function laporanTemplate(): HasOne{
        return $this->hasOne(LaporanTemplate::class);
    }

    public function notulensi(): HasOne{
        return $this->hasOne(NotulenRapat::class);
    }

    public function ketua(): HasOne{
        return $this->hasOne(KetuaRapat::class);
    }
}
