<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TindakLanjut extends Model
{
    protected $table = 'tindak_lanjut';
    protected $fillable = [
        'nomor',
        'pemeriksaan_id',
        'tanggal',
        'uraian',
        'tindak_lanjut',
        'status',
        'keterangan',
        'rekomendasi_saran',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the pemeriksaan that owns the tindak lanjut.
     */
    public function pemeriksaan(): BelongsTo
    {
        return $this->belongsTo(Pemeriksaan::class);
    }

    /**
     * Get status label with color
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'S' => '<span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Selesai</span>',
            'DP' => '<span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Dalam Proses</span>',
            'B' => '<span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Belum Diproses</span>',
            default => '<span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Tidak Diketahui</span>',
        };
    }

    /**
     * Get status text without HTML
     */
    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'S' => 'Selesai',
            'DP' => 'Dalam Proses',
            'B' => 'Belum Diproses',
            default => 'Tidak Diketahui',
        };
    }
}
