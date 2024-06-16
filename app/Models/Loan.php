<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $collection = 'loans';

    protected $fillable = [
        'member_id', 'monto', 'interes', 'plazo', 'estado',
    ];

    // Relación con Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Relación con Payments
    public function payments()
    {
        return $this->hasMany(Payment::class, 'loan_id');
    }
}
