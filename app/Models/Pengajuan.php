<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan'; // Nama tabel sesuai database
    protected $primaryKey = 'id_pengajuan'; // Primary key sesuai database
    public $incrementing = false; // Tidak auto-increment karena VARCHAR
    protected $keyType = 'string'; // Primary key bertipe string

    protected $fillable = [
        // 'id_pengajuan',
        'id_mhs',
        'kode_surat',
        'status_pengajuan',
        'file_surat',
    ];

    // Relasi ke tabel users (mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mhs', 'id_user');
    }

    // Relasi ke tabel jenis_surat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'kode_surat', 'kode_surat');
    }

    public function getStatusSuratAttribute()
{
    return [
        0 => ['label' => 'Diajukan', 'color' => 'info'],
        1 => ['label' => 'Diproses ke MO', 'color' => 'warning'],
        2 => ['label' => 'Disetujui', 'color' => 'success'],
        3 => ['label' => 'Ditolak', 'color' => 'danger'],
    ][$this->status_pengajuan] ?? ['label' => 'Diajukan', 'color' => 'info'];
}
}
