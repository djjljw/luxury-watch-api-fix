<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama
 * @property string $brand
 * @property int $harga
 * @property int $tahun_rilis
 * @property string $tipe_gerakan
 * @property string $material
 * @property string $status
 * @property string $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Watch extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     *
     * @var string
     */
    protected $table = 'koleksi_jam';

    /**
     * Atribut yang dapat diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'brand',
        'harga',
        'tahun_rilis',
        'tipe_gerakan',
        'material',
        'status',
        'foto',
    ];

    /**
     * Konversi tipe data atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'harga' => 'integer',
        'tahun_rilis' => 'integer',
    ];
}
