<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = ['kode', 'nama', 'deskripsi'];

    public function pengajuanSurat(): HasMany
    {
        return $this->hasMany(SuratPengajuan::class, 'id_jenis_surat');
    }
}
