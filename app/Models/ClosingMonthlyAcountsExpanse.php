<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingMonthlyAcountsExpanse extends Model
{
    use HasFactory;
    protected $table = 'closing_monthly_acounts_expanses';
    protected $primaryKey = 'openning_monthly_acounts_expanses_id';
}
