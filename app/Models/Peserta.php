<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
