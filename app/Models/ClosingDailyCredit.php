<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingDailyCredit extends Model
{
    use HasFactory;
    protected $table = 'closing_daily_credits';
    protected $primaryKey = 'closing_daily_credit_id';
}
