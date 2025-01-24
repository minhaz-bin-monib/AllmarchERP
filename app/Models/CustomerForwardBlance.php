<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerForwardBlance extends Model
{
    use HasFactory;
    protected $table = 'customer_forward_blances';
    protected $primaryKey = 'customer_forward_blance_id';
}
