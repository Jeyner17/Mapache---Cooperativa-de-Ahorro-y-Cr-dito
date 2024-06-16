<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $collection = 'members';

    protected $fillable = [
        'nombre', 'apellido', 'cedula', 'email', 'direccion', 'telefono', 'estado',
    ];

    protected $casts = [
        'telefono' => 'array',
        'direccion' => 'array'
    ];

    // Relación con SavingsAccounts
    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class, 'member_id');
    }

    // Relación con Loans
    public function loans()
    {
        return $this->hasMany(Loan::class, 'member_id');
    }

    // Relación con SavingsQuotas
    public function savingsQuotas()
    {
        return $this->hasMany(SavingsQuota::class, 'member_id');
    }
}
