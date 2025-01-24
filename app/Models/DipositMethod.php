<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DipositMethod extends Model
{
    use HasFactory;
    protected $table = 'diposit_methods';
    protected $primaryKey = 'diposit_method_id';
}
