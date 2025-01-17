<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDescription extends Model
{
    use HasFactory;
    protected $table = 'material_descriptions';
    protected $primaryKey ='material_description_id';
}
