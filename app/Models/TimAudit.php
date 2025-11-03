<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimAudit extends Model
{
    protected $table = 'tim_audit';
    protected $fillable = [
        'nama_tim',
        'bidang',
    ];

    public function anggota()
    {
        return $this->belongsToMany(Pegawai::class, 'tim_audit_pegawai');
    }

    public function jadwalAudits()
    {
        return $this->hasMany(JadwalAudit::class);
    }
}
