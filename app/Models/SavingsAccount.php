<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class SavingsAccount extends Model
{
    use HasFactory;

    protected $collection = 'savings_accounts';

    protected $fillable = [
        'member_id',
        'numero_cuenta',
        'saldo',
    ];

    // Relación con Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Relación con Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'savings_account_id');
    }
}
