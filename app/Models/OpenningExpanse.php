<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenningExpanse extends Model
{
    use HasFactory;
    protected $table = 'openning_expanses';
    protected $primaryKey = 'openning_expanses_id';
}
