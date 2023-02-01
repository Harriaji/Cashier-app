<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Item;

class Transaction_Details extends Model
{

    protected $guarded = [];
    protected $table = "transac_detail";

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function item(){
        return $this->belongsTo(item::class);
    }

    use HasFactory;
}
