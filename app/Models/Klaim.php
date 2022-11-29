<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'customer_nama',
        'customer_alamat',
        'product_id',
        'product_nama',
        'product_ukuran',
        'damage_id',
        'checking_by',
        'mm_awal',
        'mm_akhir',
        'no_seri',
        'tahun_produksi',
        'keterangan_klaim',
        'hasil_klaim',
        'kompensasi',
        'hasil_pabrik'
    ];

    protected $keyType = 'string';
    protected $with = ['images'];
    public $incrementing = false;

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
