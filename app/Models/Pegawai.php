<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = [
        'nama',
        'tgl_lahir',
        'jkel',
        'pangkat',
        'golongan',
        'jabatan',
        'telp',
        'alamat',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    public function timAudits()
    {
        return $this->belongsToMany(TimAudit::class, 'tim_audit_pegawai');
    }
}
