<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontlyCategory extends Model
{
    use HasFactory;
    protected $table = 'montly_categories';
    protected $primaryKey = 'montly_categories_id';
}
