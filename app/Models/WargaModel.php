<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaModel extends Model
{
    protected $table = 'tb_warga';
    const CREATED_AT = 'dt_created';
    const UPDATED_AT = 'dt_updated';
    protected $filltable = ['*'];
    
    use HasFactory;
}
