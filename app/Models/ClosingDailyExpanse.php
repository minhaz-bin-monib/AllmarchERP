<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingDailyExpanse extends Model
{
    use HasFactory;
    protected $table = 'closing_daily_expanses';
    protected $primaryKey = 'closing_daily_expense_id';
}
