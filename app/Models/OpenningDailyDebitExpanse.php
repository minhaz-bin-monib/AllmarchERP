<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenningDailyDebitExpanse extends Model
{
    use HasFactory;
    protected $table = 'openning_daily_debit_expanses';
    protected $primaryKey = 'openning_daily_debit_expanses_id';
}
