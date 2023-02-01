<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction_Details;

class Transaction extends Model
{
    
    protected $guarded = [];
    protected $table = "transac";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detail(){
        return $this->hasMany(Transaction_Details::class);
    }
    use HasFactory;
}
