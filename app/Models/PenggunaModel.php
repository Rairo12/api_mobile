<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaModel extends Model
{
    protected $table = 'tb_pengguna';
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $filltable = ['*'];
    protected $hidden = ['sandi'];

    use HasFactory;
}
