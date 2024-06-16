<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class SavingsQuota extends Model
{
    use HasFactory;

    protected $collection = 'savings_quotas';

    protected $fillable = [
       'member_id', 'monto', 'fecha_semana', 'estado', 
    ];

     // Relación con Member
     public function member()
     {
         return $this->belongsTo(Member::class, 'member_id');
     }
}
