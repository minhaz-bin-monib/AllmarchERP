<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCreditCategory extends Model
{
    use HasFactory;
    protected $table = 'daily_credit_categories';
    protected $primaryKey = 'daily_credit_category_id';
}
