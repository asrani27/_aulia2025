<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaan';
    protected $fillable = [
        'nomor',
        'jadwal_audit_id',
        'tanggal',
        'hasil_temuan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function jadwalAudit()
    {
        return $this->belongsTo(JadwalAudit::class);
    }

    /**
     * Get the tindak lanjut records for the pemeriksaan.
     */
    public function tindakLanjuts(): HasMany
    {
        return $this->hasMany(TindakLanjut::class);
    }
}
