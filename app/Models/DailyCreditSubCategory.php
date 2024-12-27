<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCreditSubCategory extends Model
{
    use HasFactory;
    protected $table = 'daily_credit_sub_categories';
    protected $primaryKey = 'daily_credit_sub_category_id';
}
