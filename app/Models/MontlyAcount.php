<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontlyAcount extends Model
{
    use HasFactory;
    protected $table = 'montly_acounts';
    protected $primaryKey = 'montly_acounts_id';
}
