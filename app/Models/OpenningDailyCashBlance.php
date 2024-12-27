<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenningDailyCashBlance extends Model
{
    use HasFactory;
    protected $table = 'openning_daily_cash_blances';
    protected $primaryKey = 'openning_daily_cash_balance_id';
}
