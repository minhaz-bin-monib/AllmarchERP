<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingDailyCashBlanceHistory extends Model
{
    use HasFactory;
    protected $table = 'closing_daily_cash_blance_histories';
    protected $primaryKey = 'closing_daily_cash_blance_history_id';
}
