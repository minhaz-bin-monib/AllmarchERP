<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferInvoiceProduct extends Model
{
    use HasFactory;
    protected $table = 'transfer_invoice_products';
    protected $primaryKey = 'transferInvoiceProduct_id';
}
