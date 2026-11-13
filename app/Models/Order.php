<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable=['id','order_number','pickup_date','created_by','client_name','client_phone','total_price','payment_status','processing_status','created_at','updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    
}
