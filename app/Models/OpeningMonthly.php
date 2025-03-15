<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningMonthly extends Model
{
    use HasFactory;

    protected $table = 'opening_monthlies';
    protected $primaryKey = 'opening_monthly_id';
}
