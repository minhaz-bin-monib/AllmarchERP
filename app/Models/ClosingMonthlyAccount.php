<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingMonthlyAccount extends Model
{
    use HasFactory;
    protected $table = 'closing_monthly_accounts';
    protected $primaryKey = 'opening_monthly_account_id';
}
