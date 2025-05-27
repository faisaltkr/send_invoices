<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceLogs extends Model
{
    protected $fillable = [
        'customer_id',
        'status',
        'pdf_path',
        'attempt_count',
        'errors',
        'generated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
