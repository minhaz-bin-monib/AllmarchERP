<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceProduct extends Model
{
    use HasFactory;
    protected $table = 'invoice_products';
    protected $primaryKey = 'salesInvoiceProduct_id';
}
