<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingDailyDebitExpanse extends Model
{
    use HasFactory;
    protected $table = 'closing_daily_debit_expanses';
    protected $primaryKey = 'closing_daily_debit_expense_id';
}
