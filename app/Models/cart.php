<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class cart extends Model
{
    use HasFactory;
    protected $fillable = ["id","item_id","qty"];

    public function item() {
        return $this->belongsTo(Item::class);
    }

}
