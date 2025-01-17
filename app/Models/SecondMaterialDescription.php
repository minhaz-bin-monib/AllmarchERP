<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondMaterialDescription extends Model
{
    use HasFactory;
    protected $table = 'second_material_descriptions';
    protected $primaryKey ='second_material_description_id';

}
