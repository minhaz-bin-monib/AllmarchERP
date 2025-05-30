<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    use HasFactory;
    protected $table = 'bank_names';
    protected $primaryKey = 'bank_name_id';
}
