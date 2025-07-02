<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPengajuan extends Model
{
    protected $table = 'surat_pengajuan';

    protected $fillable = [
        'id_users',
        'id_residents',
        'id_jenis_surat',
        'nomor_surat',
        'tanggal_pengajuan',
        'tanggal_disetujui',
        'status',
        'catatan'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'id_residents');
    }

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
}
