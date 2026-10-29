<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    public const JENIS  = ['Mesin cuci', 'Pengering'];
    public const STATUS = ['Beroperasi', 'Maintenance', 'Rusak', 'Nonaktif'];

    protected $fillable = ['kode', 'jenis', 'merek', 'kapasitas_kg', 'status'];
}