<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'customer_id',
        'status',
        'pdf_path',
        'attempt_count',
        'errors',
        'sent_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
