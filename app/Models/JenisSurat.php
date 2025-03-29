<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    /*
    (0, 'Surat Keterangan Mahasiswa Aktif'),
    (1, 'Surat Pengantar Tugas'),
    (2, 'Laporan Hasil Studi'),
    (3, 'Surat Keterangan Lulus');
    */

    protected $table = 'jenis_surat'; // Nama tabel sesuai database
    protected $primaryKey = 'kode_surat'; // Primary key sesuai database
    // public $incrementing = false;
    protected $keyType = 'int'; // Tipe data primary key

    protected $fillable = [
        'kode_surat',
        'jenis_surat',
    ];
}
