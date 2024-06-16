<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $collection = 'transactions';

    protected $fillable = [
        'savings_account_id', 'tipo', 'monto', 'descripcion', 'estado',
    ];

    // Relación con SavingsAccount
    public function savingsAccount()
    {
        return $this->belongsTo(SavingsAccount::class, 'savings_account_id');
    }
}
