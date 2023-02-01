<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Transaction_Details;
use App\Models\cart;

class Item extends Model
{
    protected $guarded = [];

    protected $table = "item";
    
    public function category(){
        return $this-> belongsTo(Category::class, 'category_id');
    }
    public function cart(){
        return $this-> hasOne(cart::class, 'item_id');
    }
    public function transaction(){
        return $this-> hasManyThrough(Transaction::class,Transaction_Details::class);
    }
    use HasFactory;
   

}
