<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferInvoice extends Model
{
    use HasFactory;
    protected $table = 'transfer_invoices';
    protected $primaryKey = 'transferInvoice_id';
}
