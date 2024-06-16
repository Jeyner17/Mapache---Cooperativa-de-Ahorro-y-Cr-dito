<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $collection = 'payments';

    protected $fillable = [
        'loan_id', 'monto', 'tipo', 'estado'
    ];

    // Relación con Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
