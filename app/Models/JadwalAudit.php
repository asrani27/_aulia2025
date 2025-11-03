<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAudit extends Model
{
    protected $table = 'jadwal_audit';
    protected $fillable = [
        'nama_instansi',
        'alamat',
        'tim_audit_id',
        'tgl_audit',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tgl_audit' => 'date',
    ];

    public function timAudit()
    {
        return $this->belongsTo(TimAudit::class);
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
