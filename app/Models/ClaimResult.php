<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimResult extends Model
{
    use HasFactory;

    //field yang bisa diisi atau dirubah
    protected $fillable = ['nama_hasil'];
}
