<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    //field yang bisa diisi atau dirubah
    protected $fillable = ['id', 'distributor_id', 'nama', 'alamat', 'telp', 'email'];

    //merubah primarykey dari id ke string
    protected $keyType = 'string';

    protected $with = ['distributor'];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class)->withDefault();
    }
}
