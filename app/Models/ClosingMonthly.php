<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingMonthly extends Model
{
    use HasFactory;
    protected $table = 'closing_monthlies';
    protected $primaryKey = 'opening_monthly_id';
}
