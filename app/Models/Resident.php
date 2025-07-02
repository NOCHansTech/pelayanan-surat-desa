<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resident extends Model
{
    protected $fillable = [
        'users_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id_users');
    }

    public function pengajuanSurat(): HasMany
    {
        return $this->hasMany(SuratPengajuan::class, 'id_residents');
    }
}
