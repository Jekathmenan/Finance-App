<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    //protected $guarded = [];  

    protected $fillable = [
        'type', 'date', 'repeattype', 'amount', 'category', 
        'account_from', 'account_to', 'user_id', 'note', 'description'
    ];

    public function accountFrom() 
    {
        return $this->belongsTo(Account::class, 'account_from');
    }

    public function accountTo() 
    {
        return $this->belongsTo(Account::class, 'account_to');
    }

    public function category()
    {
        return $this->belongsTo(TransferCategory::class, 'category');
    }
}
