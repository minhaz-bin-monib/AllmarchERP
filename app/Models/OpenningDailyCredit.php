<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenningDailyCredit extends Model
{
    use HasFactory;
    protected $table = 'openning_daily_credits';
    protected $primaryKey = 'openning_daily_credits_id';
}
