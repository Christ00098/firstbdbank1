<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'description',
        'trans_id',
        'account_number',
        'account_name',
        'bank_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
