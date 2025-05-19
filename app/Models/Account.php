<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getBalance()
    {
        $incomes = $this->hasMany(Transfer::class, 'account_to')->where('user_id', auth()->id())->sum('amount');
        $expenses = $this->hasMany(Transfer::class, 'account_from')->where('user_id', auth()->id())->sum('amount');
        $balance = $this->starting_amount + $incomes - $expenses;
        return $balance != 0 ? $balance / 100 : $balance;
    }
}
